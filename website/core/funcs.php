<?php

function csrfToken(){
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        echo json_encode(["status" => 400,"message" => "Refresh your page"]);
        exit;
    }
}

function Authenticated(): bool {
    if(!isset($_SESSION[SESSION_KEY]['auth']) || $_SESSION[SESSION_KEY]['auth'] != true) return false;
    else return true;
}

function Authorization(){
    // check if authenticate
    if(!Authenticated()) return false;
     
    // check for subscription
    return true;
}

function callAPI($method=null, $url=null, $headers=null, $request=null){
    if(is_null($url)) die('Request parameters required');
    if(is_array($request)) $request = json_encode($request);   

    $curl = curl_init();

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

function passEncrype($pass,$cost=10){
    $options = ['cost'=>$cost];
    return password_hash($pass,PASSWORD_BCRYPT,$options);
}

function unnumber_format($value=null){
    return filter_var(str_replace('.00','',$value),FILTER_SANITIZE_NUMBER_INT);
}

function datetime($format='Y-m-d H:i:s',$value=null){
    return date($format,strtotime($value));
}

function strRand($length=6){
    $length = max(4, $length); 
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $otp = '';
    $maxIndex = strlen($characters)-1;
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[random_int(0, $maxIndex)];
    }
    return $otp;    
}

function intRand($length=6){
    $length = max(4, $length);
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= random_int(0, 9);
    }
    return validInt($otp);
} 

function validString(?string $value): string|false {
    if ($value !== null && strlen(trim($value)) > 0) {
        return filter_var(trim($value), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    return false;
}

function validInt($value = null): int|false {
    if (filter_var($value, FILTER_VALIDATE_INT) !== false) {
        return (int)$value;
    }
    return false;
}

function validPhone($phone){
    $phone = preg_replace('/\D/', '', $phone);
    if (substr($phone, 0, 1) === '0') {
        $phone = '254' . substr($phone, 1);
    } elseif (substr($phone, 0, 3) !== '254'){
        $phone = '254'.$phone;
    }
    
    $pattern = '/^254(?:[17]\d{8}|[2-9]\d{7})$/';
    if (preg_match($pattern, $phone)) {
        return (int)$phone;
    } else {
        return false;
    }
}

function formatValue($value, $isString = false) {
    if (!isset($value) || $value === '') return 'NULL';
    return $isString ? "'" . addslashes($value) . "'" : $value;
}

function validEmail(?string $email): string|false {
    $sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($sanitized, FILTER_VALIDATE_EMAIL)) {
        return strtolower($sanitized);
    }
    return false;
}

function print_j($value=null){
    header('Content-Type: application/json');
    print_r(json_encode($value));
}

function redirect($page=null){
    header("Location: ".$page);
    exit;
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

function writeToFile($file = null, $data = null) {
    if (empty($file) || $data === null) {
        error_log("writeToFile: Invalid file path or data provided. File: '" . (string)$file . "', Data type: " . gettype($data));
        return false;
    }
    
    $directory = dirname($file);
    
    if (!file_exists($directory)) {
        if (!mkdir($directory, 1777, true)) {
            error_log("writeToFile: Failed to create directory '$directory'. " ."Please check parent directory permissions or SELinux/AppArmor policies.");
            return false;
        }
    }
    
    if (is_array($data)) {
        $data = json_encode($data);
        if ($data === false) {
            error_log("writeToFile: Failed to encode data to JSON for file '$file'.");
            return false;
        }
    }
    
    $desiredFilePermissions = 1777;
    $logEntry = date('Y-m-d H:i:s') . " : " . $data;

    if (file_exists($file)) {
        $logEntry = "\n" . $logEntry;
    }

    // Attempt to write the content to the file.
    try {
        $result = file_put_contents($file, $logEntry, FILE_APPEND | LOCK_EX);
        if ($result === false) {
            error_log("writeToFile: Failed to write content to file '$file'. " ."This usually means the PHP user lacks write access. " ."Check file/directory permissions or SELinux/AppArmor policies.");
            return false;
        }
        chmod($file, $desiredFilePermissions);
        chown($file, "www-data");
        return true;
    } catch (Exception $e) {
        error_log("writeToFile: An unexpected error occurred while writing to file '$file'. " ."Message: " . $e->getMessage());
        return false;
    }
}

function getIp() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}