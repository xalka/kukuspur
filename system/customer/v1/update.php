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
    'action' => 3,
    'active' => 1,
    'verified' => 1,
    'customerId' => validInt($req['customerId'])
];

try {
    $customer = PROC(CUSTOMER($dbdata)); // [0][0];
    if(isset($customer[0][0])) $customer = $customer[0][0];
    else {
        $response = [
            'status' => 401,
            'error' => 'Customer not found'
        ];          
        exit(print_j($response));
    }
    
    // validate password
    if(!password_verify($req['password'],$customer['pass'])){
        $response = [
            'status' => 401,
            'error' => 'Invalid password'
        ];          
        exit(print_j($response));

    } 

    $dbdata = [
        'action' => 9,
        'customerId' => $customer['customerId'],
        'fname' => validString($req['fname']),
        'lname' => validString($req['lname']),
        'phone' => validPhone($req['phone']),
        'email' => validEmail($req['email'])
    ];

    $updated = PROC(CUSTOMER($dbdata))[0][0];

    if($updated['updated']==1){
        $response = [
            'status' => 200
        ];     
    } elseif($updated['updated']==0){
        $response = [
            'status' => 401,
            'error' => 'no new changes'
        ];
    } else {
        $response = [
            'status' => 401,
            'error' => 'unable to update'
        ];         
    };

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);