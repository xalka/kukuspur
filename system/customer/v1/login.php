<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

$errors = [];

// 2. Validate
$dbdata = [
    'action' => 10,
    'active' => 1,
    'verified' => 1
];

if(isset($req['phone']) && !empty($req['phone'])) $dbdata['phone'] = validPhone($req['phone']);
else $dbdata['email'] = validEmail($req['email']);

try {
    $customer = PROC(CUSTOMER($dbdata))[0][0];
    
    // validate password
    if(password_verify($req['password'],$customer['pass'])){
        $response = [
            'status' => 200,
            'id' => $customer['customerId'],
            'fname' => $customer['fname'],
            'lname' => $customer['lname'],
            'phone' => $customer['phone'],
            'email' => $customer['email'],
            'isAdmin' => $customer['isAdmin']
        ];
    } else {
        $response = [
            'status' => 400,
            'message' => 'The customer does not exist'
        ];
    }

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);