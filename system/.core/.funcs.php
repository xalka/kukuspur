<?php

function mongoDateTime(array $data): array {
    return array_map(function($obj) {
        $obj->created = localdate($obj->created);
        if(isset($obj->delivered)) $obj->delivered = localdate($obj->delivered);
        $timestamp = strtotime($obj->created);
        $obj->date = date('Y-M-d', $timestamp);
        $obj->time = date('H:i', $timestamp);
        return $obj;
    }, $data);
}

function getUserFromPhone($phone=null){
    $url = OAUTH_ENDPOINT.'/user/v1/user?phone='.$phone;
    $header = array(
        'content-type: application/json',
        'authtoken: '.TOKEN,
        // 'userphone: no-cache'        
    );
    curlGet($url=null,$header=null);
}

function findIndexByName($items, $name) {
    foreach ($items as $index => $item) {
        if (isset($item['Name']) && $item['Name'] === $name) {
            return $index;
        }
    }
    return -1; // Return -1 if not found
}

function authorized(){
    // $location = $_SERVER['REQUEST_URI'];
    if(!isset($_SESSION[SESSION_KEY])) redirect('/user?action=logout');
    else {
        return 1;
        /*if(!isset($_SESSION[SESSION_KEY]['auth'])) $this->redirect('/user/logout'.$location);
        else { // return 1;
            $page = explode('/',$_SERVER['REQUEST_URI'])[1];
            $roles = explode(',',$this->loggedInUser()['roles']);
            array_push($roles,'user');
            // print_r($page);
            // print_r($roles);

            if(in_array('inpatient',$roles) && $page=='provider'){
                array_push($roles,'provider');
            }

            // die();
            if(!in_array($page,$roles) && !empty($page)){ // return 0;
                $this->ReqBad();
                // $this->redirect('errors/forbidden');
                // $this->redirect('/'.$roles[0]);
            } else return 1;
        }*/
    }
}

function authenticate($request=null){
    $reqheaders = getallheaders();
    if(!isset($reqheaders['Businessid'])) ReqForbidden();
    if(isset($reqheaders['X-Oauth'])){
        $url = DOMAIN.'/oauth/v1/authenticate';
        $headers = [
            'Content-Type: application/json',
            'Reference: '.$reqheaders['Reference'],
            'BusinessId: '.$reqheaders['Businessid'],
            'UserId: '.$reqheaders['Userid'],
            'Authtoken: '.$reqheaders['Authtoken']
        ];
        if(!deJson(callAPI('POST',$url,$headers,$request))['auth']) ReqForbidden();
    }
}

function callAPI2($method=null, $url=null, $headers=null, $request=null ){
    if(is_null($url)) die('Request parameters required');
    
    $curl = curl_init();

    if(isset($request['EMAIL_ATTACHMENTS']) && is_array($request['EMAIL_ATTACHMENTS'])){
        $headers[] = 'Content-Type: multipart/form-data';
        $attachments = [];
        foreach ($request['EMAIL_ATTACHMENTS'] as $index => $filePath) {
            if (file_exists($filePath)) {
                $attachments["attachments[$index]"] = new CURLFile($filePath, mime_content_type($filePath), basename($filePath));
            }
        }
        unset($request['EMAIL_ATTACHMENTS']);
        $request = array_merge(["data" => json_encode($request)], $attachments);
    } else {
        if(is_array($request)) $request = json_encode($request);
        $headers[] = 'Content-Type: application/json';
    }    
    
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, true);
            if($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);                              
            break;

        case "PATCH":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
            if($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);                              
            break;

        case "GET":
        default:
            if($request) $url = sprintf("%s?%s", $url, http_build_query(json_decode($request,1)));
            break;
    }

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 1
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 2    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
        
    // OPTIONS:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_SSLCERT, '/etc/ssl/mycerts/server.crt');
    // curl_setopt($curl, CURLOPT_SSLKEY, '/etc/ssl/mycerts/server.key');
    // curl_setopt($curl, CURLOPT_CAINFO, '/etc/ssl/mycerts/server.crt');

    // EXECUTE:
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        $error = curl_error($curl);
        curl_close($curl);
        return "Curl error: " . $error;
    }
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ($status === 200) return $response;
    else return "Failed; Status: $status. Response: $response";
}

function callAPI($method=null, $url=null, $headers=null, $request=null ){
    if(is_null($url)) die('Request parameters required');
    
    $curl = curl_init();

    if(isset($request['EMAIL_ATTACHMENTS']) && is_array($request['EMAIL_ATTACHMENTS'])){
        $headers[] = 'Content-Type: multipart/form-data';
        $attachments = [];
        foreach ($request['EMAIL_ATTACHMENTS'] as $index => $filePath) {
            if (file_exists($filePath)) {
                $attachments["attachments[$index]"] = new CURLFile($filePath, mime_content_type($filePath), basename($filePath));
            }
        }
        unset($request['EMAIL_ATTACHMENTS']);
        $request = array_merge(["data" => json_encode($request)], $attachments);
    } else {
        if($method !== 'GET' && is_array($request)) $request = json_encode($request);
        // $headers[] = 'Content-Type: application/json';
    }
    
    switch ($method){
        case "POST":
            // print_r($request); exit;
            curl_setopt($curl, CURLOPT_POST, true);
            if($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);                              
            break;

        case "PATCH":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
            if($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);                              
            break;

        case "GET":
        default:
            // print_r(http_build_query($request)); exit;
            if($request && !empty($request)) $url = sprintf("%s?%s", $url, http_build_query($request));
            break;
    }

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 1
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 2    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
        
    // OPTIONS:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_SSLCERT, '/etc/ssl/mycerts/server.crt');
    // curl_setopt($curl, CURLOPT_SSLKEY, '/etc/ssl/mycerts/server.key');
    // curl_setopt($curl, CURLOPT_CAINFO, '/etc/ssl/mycerts/server.crt');

    // EXECUTE:
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        $error = curl_error($curl);
        curl_close($curl);
        return "Curl error: " . $error;
    }
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ($status === 200) return $response;
    else return "Failed; Status: $status. Response: $response";
}

function decrypt($data) { return $data;
    $data = base64_decode($data);
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data,0,$ivLength);
    $encryptedData = substr($data,$ivLength);
    return openssl_decrypt($encryptedData,'aes-256-cbc',PASSWORD_KEY,0,$iv);
}

function passEncrype($pass,$cost=10){
    $options = ['cost'=>$cost];
    return password_hash($pass,PASSWORD_BCRYPT,$options);
}

function unnumber_format($value=null){
    return filter_var(str_replace('.00','',$value),FILTER_SANITIZE_NUMBER_INT);
}

function strRand($start=7,$length=5){
    return strtoupper(substr(md5(rand(0,time())),$start,$length)).time();
}

function intRand($length=6){
    // return str_pad(mt_rand(0,999999),6,'T',STR_PAD_LEFT);
    return mt_rand(0,999999);
} 

function strRandSioka($length=6){
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return strtoupper($str);    
}

function validString($value=null){
    return (String)$value;
    // if(filter_var($value, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-zA-Z\s]/")) )) {
    //     return filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // } else return false;
}

function validInt($value=null){
    if(filter_var($value, FILTER_VALIDATE_INT)) 
        return (int)filter_var($value,FILTER_SANITIZE_NUMBER_INT);
    else return false;
}

function validPhone($phone) {
    $phone = preg_replace('/\D/', '', $phone);
    if (substr($phone, 0, 1) === '0') {
        $phone = '254' . substr($phone, 1);
    } elseif (substr($phone, 0, 3) !== '254'){
        $phone = '254'.$phone;
    }

    // Validate the phone number against the Kenyan format
    $pattern = '/^254(?:[17]\d{8}|[2-9]\d{7})$/';
    if (preg_match($pattern, $phone)) {
        return (int)$phone; // Return as an integer
    } else {
        return false; // Invalid phone number
    }
}



function validPhoneDel($phone){  
    return (int)'254'.substr($phone,-9,9);
    // Remove any non-digit characters from the phone number
    $phone = preg_replace('/\D/', '', $phone);

    // Validate the phone number against the Kenyan format
    $pattern = '/^(?:\+?254|0)(?:[17]\d{8}|[2-9]\d{6,7})$/';
    if (preg_match($pattern, $phone)) {
        // Format the phone number consistently (e.g., add country code and separators)
        $phone = '254' . substr($phone, -9, 9);
        return (int)$phone;
    } else {
        return false; // Invalid phone number
    }
}

function validEmail($email=null){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    } else return 0;  
}

function generateToken($prefix=null){
    // $prefix = $prefix ? $prefix : time();
    // return crypt($prefix.intRand(20).strRand(3,23)).time().crypt($prefix.intRand(20).strRand(3,23));
    return uniqid().strRand(30).intRand(time()).time().strRand(0,time()).intRand(time());
}

function print_j($value=null){
    // http_response_code((int)$code);
    header('Content-Type: application/json');
    print_r(json_encode($value));
}

function redirect($page=null){
    header("Location: ".$page);
    exit;
}

function enJson($value=null){
    return json_encode($value);
}

function deJson($value=null){
    // header('Content-Type: text/plain; charset=utf-8');
    return json_decode($value,true);
}

function ReqJson(){
	if($_SERVER['HTTP_CONTENT_TYPE'] == 'application/json') return 1;
	else return 0;
}

function ReqAjax(){
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&&strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') return 1;
	else return 0;
}

function ReqPost(){
    if($_SERVER['REQUEST_METHOD']=='POST') return 1;
    else return 0;
}

function ReqGet(){
    if($_SERVER['REQUEST_METHOD']=='GET') return 1;
    else return 0;
}

function ReqDelete(){
    if($_SERVER['REQUEST_METHOD']=='DELETE') return 1;
    else return 0;
}	

function ReqPut(){
    if($_SERVER['REQUEST_METHOD']=='PUT') return 1;
    else return 0;
}

function ReqBad(){
    header('HTTP/1.0 400 Bad Request');
    http_response_code(400);
    exit;
}

function ReqNotFound(){
	header("HTTP/1.0 404 Not Found");
    http_response_code(404);
	exit;
}

function ReqForbidden(){
    header("HTTP/1.0 403 Forbidden");
    http_response_code(403);
    exit;
}

function ReqInternalServerError(){
    header("HTTP/1.0 500 Internal Server Error");
    http_response_code(500);
    exit;
}

function ReqMethodNotAllowed(){
    header("HTTP/1.0 405 Method Not Allowed");
    http_response_code(405);
    exit;
}

function writeToFile($file = null, $data = null) { // return true;
    // Validate file and data
    if (empty($file) || empty($data)) {
        error_log("writeToFile: Invalid file path or data provided.");
        return false;
    }

    // Ensure the parent directory exists
    $directory = dirname($file);
    if (!file_exists($directory)) {
        if (!mkdir($directory, 0755, true)) {
            error_log("writeToFile: Failed to create directory $directory.");
            return false;
        }
        chmod($directory, 0755); // Ensure directory permissions are correct
    }

    if(is_array($data)) $data = json_encode($data); 

    // Write to the file
    try {
        if (file_exists($file)) {
            file_put_contents($file, "\n" . date('H:i:s') . " : $data", FILE_APPEND | LOCK_EX);
        } else {
            file_put_contents($file, date('H:i:s') . " : $data", LOCK_EX);
            chmod($file, 0777); // Set appropriate file permissions [ 0644 ]
            exec('chmod a+w ' . escapeshellarg($file));
        }
        return true; // Successfully written
    } catch (Exception $e) {
        error_log("writeToFile: Error writing to file $file. Message: " . $e->getMessage());
        return false;
    }
}
