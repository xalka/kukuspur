<?php

// print_r($_POST);

// compoare id the two password are the same
if($_POST['password'] != $_POST['confirm']){
    print_j([
        'status' => 401,
        'message' => 'The two passwords dont match'
    ]);
    exit;
}

// push to system 
$key = key($_SESSION[SESSION_KEY]);
$request = [
    $key => base64_decode($_SESSION[SESSION_KEY][$key]),
    'code' => $_POST['code'],
    'password' => encrypt($_POST['password'])
];

$reset = json_decode(callAPI('POST','customer/v1/resetpassword',$request, $headers),1);

if($reset['status'] == 200){
    $_SESSION = null;
    unset($_SESSION);

    $response = [
        'status' => 201,
        'url' => 'login',
        'delay' => 0,
        'message' => 'Successful'
    ];  
} else {
    $response = [
        'status' => 400,
        'message' => 'Please try again'
    ];    
}

print_j($response);