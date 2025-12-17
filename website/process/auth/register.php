<?php

// check if $_POST is empty

$url = 'customer/v1/register';

$request = [
    'fname' => $_POST['fname'],
    'lname' => $_POST['lname'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'password' => $_POST['password'],
    // 'password' => encrypt($_POST['password'])
];

$return = json_decode(callAPI('POST', $url, $_POST, $headers),1);

if($return['status'] == 201){
    // set session
    $sess = [
        'auth' => 0,
        'action' => 'activation',
        // 'type' => $return['type'],
        'phone' => isset($_POST['phone']) ? base64_encode($_POST['phone']) : null,
        'email' => isset($_POST['email']) ? base64_encode($_POST['email']) : null
    ];
    $_SESSION[SESSION_KEY] = $sess;
    $return['url'] = 'activate';
    $return['message'] = 'Verification code has been sent to you';
}

print_j($return);

// redirect to verification page