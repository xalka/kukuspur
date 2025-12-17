<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.procedures.php';
require __dir__.'/../../.core/.mysql.php'; 

// POST request only
if(!ReqPost()) ReqBad();

$headers = getallheaders();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1); 

// 2. Validate

$otp = intRand();

// 4. Save into mysql
$dbdata = [
    'action' => 5,
    'typeId' => 1,
    'fname' => $req['fname'],
    'lname' => $req['lname'],
    'phone' => validPhone($req['phone']),
    'email' => validEmail($req['email']),
    'vcode' => $otp,
    'password' => passEncrype(decrypt($otp)),
    'passreset' => 1
];

try {
    $return1 = PROC(CUSTOMER($dbdata))[0][0];

    if(isset($return1['created']) && $return1['created']==0){
        $response = [
            'status' => 401,
            'message' => $return1['message']
        ];
        if(isset($return1['phone'])) $response['errors']['phone'] = "Phone number is taken";
        if(isset($return1['email'])) $response['errors']['email'] = "Email is taken";
        print_j($response);
        exit;
    }

    // send email
    
    // send otp

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

// 7. Respond with a json
print_j($response);