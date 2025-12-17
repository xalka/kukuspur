<?php

function cartSummary($items=null,$shipping=150){
    $data = [
        'subtotal' => 0,
        'discount' => 0,
        'tax' => 0,
        'total' => 0,
    ];
    
    foreach ($items as $item) {
        $itemQuantity = $item['qty'];
        $itemPrice = $item['price'];
        $itemDiscount = $item['discount']; // Assuming this is a fixed discount amount per item
        $itemTaxRate = $item['tax'];      // Assuming this is a decimal tax rate (e.g., 0.00 for 0%, 0.15 for 15%)
    
        // Calculate subtotal for the current item (before discount and tax)
        $itemSubtotal = $itemQuantity * $itemPrice;
        $data['subtotal'] += $itemSubtotal;
    
        // Calculate discount for the current item
        $itemTotalDiscount = $itemQuantity * $itemDiscount;
        $data['discount'] += $itemTotalDiscount;
    
        // Calculate amount after discount for tax calculation
        $priceAfterDiscount = $itemSubtotal - $itemTotalDiscount;
    
        // Calculate tax for the current item
        $itemTotalTax = $priceAfterDiscount * $itemTaxRate;
        $data['tax'] += $itemTotalTax;
    
        // Calculate total for the current item (price - discount + tax)
        $itemGrandTotal = $priceAfterDiscount + $itemTotalTax;
        $data['total'] += $itemGrandTotal;
    }
    
    $data['shipping'] = $shipping;
    
    $data['total'] += $shipping;
    
    foreach ($data as $key => $value) {
        $data[$key] = number_format(ceil($value), 2);
    }
    return $data;    
}

function uploadContactsFile($file=null,$title=null){  
    if (isset($file) && $file['error'] === 0) {
        $filename = uniqid().time().'_'.strtolower($title.'.'.$file['name']);
        $targetPath = BASE_DIR.'uploads/'.$filename;
        $errors = null;

        if($file['error'] !== UPLOAD_ERR_OK){
            return [
                'status' => 400,
                'message' => 'Error during upload: '. $file['error']
            ];
        }
        
        $allowedTypes = [
            'text/csv',  // CSV
            'application/vnd.ms-excel',  // XLS
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // XLSX
            'application/vnd.ms-excel.sheet.macroEnabled.12', // XLSM
            'application/vnd.oasis.opendocument.spreadsheet' // ODS
        ];

        if(!in_array($file['type'], $allowedTypes)){
            return [
                'status' => 400,
                'message' => 'Invalid file type'
            ];             
        }
        
        if($file['size'] > FILE_MAX_SIZE){
            return [
                'status' => 400,
                'message' => 'File size exceeds the maximum limit of '.FILE_MAX_SIZE.' GB'
            ];
        }
        
        if (is_null($errors) && move_uploaded_file($file['tmp_name'],$targetPath)) {
            $request = [
                'title' => validString($title)
            ];

            if (($handle = fopen($targetPath, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if(is_numeric($data[0])){
                        $contacts[] = [
                            'phone' => validPhone($data[0]),
                            'fname' => validString($data[1]),
                            'lname' => validString($data[2])
                        ];
                    }
                }
                fclose($handle);
                return $contacts;
            } else {
                return [
                    'status' => 400,
                    'message' => 'Error opening file.'
                ];
            }
            unlink($targetPath);
        } else {
            return [
                'status' => 400,
                'message' => 'Error uploading file.'
            ];
        }
    } else {
        return [
            'status' => 400,
            'message' => 'No file uploaded.'
        ];
    }
}

function Authorize(string $module = null, ?string $action = null): bool {
    if(!isset($_SESSION[SESSION_KEY]['auth']) || !isset($_SESSION[SESSION_KEY]['roleId'])) return false;

    global $role;

    $request = [ 
        'roleId' => base64_decode($_SESSION[SESSION_KEY]['roleId'])
    ];
    $role = json_decode(callAPI('GET','role/v1/view',$request,[]),1)[0]['permissions'];

    if(!array_key_exists($module, $role)) return false;
    
    if(!in_array($action,array_column($role[$module],'permission')) ) return false;

    return true;

    /*
    // Validate session and permissions structure
    if (!isset($_SESSION[SESSION_KEY]['permissions'])) {
        error_log('Authorization failed: No permissions found in session');
        return false;
    }

    $permissions = $_SESSION[SESSION_KEY]['permissions'];
    // get permissions from api

    // Validate module exists in permissions
    if (!isset($permissions[$modurl])) {
        error_log("Authorization failed: Module '$modurl' not found in permissions");
        return false;
    }

    $modulePermissions = $permissions[$modurl];

    // Validate module permissions structure
    if (!isset($modulePermissions['perms']) || !is_array($modulePermissions['perms'])) {
        error_log("Authorization failed: Invalid permissions structure for module '$modurl'");
        return false;
    }

    // Check action permission if specified
    if ($action !== null) {
        $allowedActions = array_column($modulePermissions['perms'], 'permission');
        if (!in_array($action, $allowedActions, true)) {
            error_log("Authorization failed: Action '$action' not allowed for module '$modurl'");
            return false;
        }
    }

    return true;
    */
}

function ValidateSession() {
    if ($_SESSION[SESSION_KEY]['ip'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION[SESSION_KEY]['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_destroy();
        header('Location: /login.php');
        exit();
    }

    // Session timeout (30 minutes)
    if (time() - $_SESSION[SESSION_KEY]['last_activity'] > 1800) {
        session_destroy();
        header('Location: /login.php?timeout=1');
        exit();
    }
}

function Authentication(){
    $authPages = ['login.php', 'register.php', 'activate.php', 'forgot.php', 'resetpassword.php'];
    $currentPage = basename($_SERVER['SCRIPT_NAME']);

    // Check if user is logged in
    $isLoggedIn = isset($_SESSION[SESSION_KEY]) && isset($_SESSION[SESSION_KEY]['auth']) && $_SESSION[SESSION_KEY]['auth'] && !empty($_SESSION[SESSION_KEY]['id']);

    // Redirect logic for authenticated users
    if ($isLoggedIn) {
        // If trying to access auth page, redirect to dashboard
        if (in_array($currentPage, $authPages)) {
            $redirectUrl = $_SESSION[SESSION_KEY]['last_visited'] ?? '/';
            header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
            exit();
        }
        
        // Update last visited time
        $_SESSION[SESSION_KEY]['last_activity'] = time();
        return true;
    }

    // Redirect logic for guests
    if (!in_array($currentPage, $authPages)) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: /login');
        exit();
    }

    return false;
}

function generateCSRFToken() {
    if(empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function isLoggedInDel(){
    if(isset($_SESSION[SESSION_KEY]) && $_SESSION[SESSION_KEY]['auth']){
        if(isset($_SERVER['HTTP_REFERER'])) $url = $_SERVER['HTTP_REFERER'];
        // elseif($_SESSION[SESSION_KEY]['action']=='activation') $url = '/activate';
        else $url = '/';
        redirect($url);
    }
}

function authenticateDel($url = '/dashboard') {
    // Ensure the session is started and the session key is defined
    if (!isset($_SESSION[SESSION_KEY])) {
        redirect('/login');
    } 

    // Check if the user needs to activate
    if (isset($_SESSION[SESSION_KEY]['action']) && $_SESSION[SESSION_KEY]['action']=='activation') return true;

    // Check if the user is authenticated
    if (!isset($_SESSION[SESSION_KEY]['auth'])) ReqForbidden();

    // Remove it once the permissions work
    return true;

    // Normalize the requested URL path
    $modurl = ltrim(parse_url($url)['path'], '/');

    // Define allowed URLs for direct access
    $allowedUrls = ['contribution', 'loan', 'profile', 'guarantee'];

    // Check if the requested URL is in the allowed list
    if (!in_array($modurl, $allowedUrls)) {
        $perms = $_SESSION[SESSION_KEY]['permissions'] ?? [];

        // Redirect if permissions do not allow access
        if (!array_key_exists($modurl, $perms)) {
            redirect('/profile'); // Optionally, you can call ReqForbidden() here as well
        }

        // Check for query parameters
        if (isset(parse_url($url)['query'])) {
            parse_str(parse_url($url)['query'], $params);
            $action = $params['action'] ?? null;

            // Validate action permissions
            if ($action && !in_array($action, array_column($perms[$modurl]['perms'], 'permission'))) {
                ReqForbidden();
            }
        }
    }
}

function authorizeDel($modurl=null,$action=null){ //return 1;
    // $headers = getallheaders();
    // if(!isset($headers['Saccoid'])) ReqForbidden();
    if(!isset($_SESSION[SESSION_KEY]['permissions'])) return 0;
    $perms = $_SESSION[SESSION_KEY]['permissions'];
    // $selfurl = ltrim(parse_url($url)['path'],'/');
    if(!in_array($modurl,array_keys($perms))) return 0;
    elseif(!is_null($action) && !in_array($action,array_column($perms[$modurl]['perms'],'permission'))) return 0;
    else return 1;
}

function callAPI($method = 'GET', $url = null, $request = null, $headers = null, $timeout = 300){
    if(is_null($url)) return 'Error: URL parameter is required';
    
    $curl = curl_init();

    // Set headers if provided
    if ($headers) curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // Handle different HTTP methods
    switch (strtoupper($method)) {
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, true);
            // if (isset($request['file']) && is_file($request['file'])) {
            if (isset($request['file'])) {
                $file = $request['file']['file'];
                $request['file'] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
            }
            if(is_array($request)) $request = json_encode($request);
            if ($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            break;

        case 'PUT':
        case 'PATCH':
        case 'DELETE':
            if(is_array($request)) $request = json_encode($request);

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
            if ($request) curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            break;

        case 'GET':
        default:
            if ($request) {
                $url = sprintf("%s?%s", $url, http_build_query($request));
                // print_r($url); exit;
            }
            break;
    }
    
    // Set the cURL options
    $url = API_HOST.$url;
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

    // Execute the cURL request
    $result = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        $error_message = curl_error($curl);
        curl_close($curl);
        return 'Curl error: ' . $error_message;
    }

    // Close cURL session
    curl_close($curl);

    // Return the result
    return $result ? $result : 'No response or empty result';
}

function encrypt($data) { return $data;
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encryptedData = openssl_encrypt($data,'aes-256-cbc',PASSWORD_KEY,0,$iv);
    return base64_encode($iv.$encryptedData);
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

function activeTab($tab){
    return strpos($_SERVER['REQUEST_URI'],$tab) ? 'active' : '';
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

function validString(?string $value): string|false {
    // Remove extra spaces
    $value = trim($value);
    // Validate: allow only letters and spaces
    if ($value !== '' && preg_match('/^[a-zA-Z\s]+$/', $value)) {
        // Sanitize: convert special characters to HTML entities
        return filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    return false; // Invalid input
}


function validInt($value=null){
    if(filter_var($value, FILTER_VALIDATE_INT))
        return (int)filter_var($value,FILTER_SANITIZE_NUMBER_INT);
    else return false;
}

function validPhone($phone){
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

function print_j($value=null){
    // http_response_code((int)$code);
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

function writeToFile($file=null,$data=null){
    if (file_exists($file)) {
        file_put_contents($file, "\n".date('H:i:s')." : $data", FILE_APPEND);
    } else {
        file_put_contents($file, date('H:i:s')." : $data");
        exec("chown -R www-data:www-data ".$file);
        chmod($file,0644);
    }
}
