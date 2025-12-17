<?php

// Validate

$request = [
    'code' => validInt($_POST['code']),
    'phone' => base64_decode($_SESSION[SESSION_KEY]['phone']),
    'email' => base64_decode($_SESSION[SESSION_KEY]['email'])
];

$customer = json_decode(callAPI('POST','customer/v1/activate',$request),1);
// print_j($customer); exit;

if(isset($customer['status']) && $customer['status']==200){
    // $_SESSION[SESSION_KEY] = [
    //     'auth' => 1,
    //     'id' => base64_encode($customer['id']),
    //     'phone' => base64_encode($customer['phone']),
    //     'email' => base64_encode($customer['email']),
    //     'fname' => base64_encode($customer['fname']),
    //     'lname' => base64_encode($customer['lname']),
    //     'cname' => base64_encode($customer['cname']),
    //     'type' => base64_encode($customer['type']),
    //     'groupId' => base64_encode($customer['groupId']),
    //     'groups' => base64_encode($customer['groups']),
    //     'alphanumeric' => 'testTP',
    //     'alphanumericId' => '2'
    //     // 'last_activity' => time()
    // ];  
    
    $response = [
        'status' => 201,
        'url' => 'logout',
        'delay' => 0,
        'message' => 'Successful'
    ];
} else {
    $response = [
        'status' => 400,
        'message' => $customer['message']
    ];
}
print_j($response);



// Authenticate

// Update mysql

// Update mongodb

// Return response