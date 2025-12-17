<?php

// validate

if(is_numeric($_POST['phonemail'])){
    $request['phone'] = validPhone($_POST['phonemail']);
} else {
    $request['email'] = $_POST['phonemail'];
}

$reset = json_decode(callAPI('POST','customer/v1/forgot',$request, $headers),1);

if($reset['status']==201){
    // session
    $_SESSION[SESSION_KEY] = [
        key($request) => base64_encode($request[key($request)])
    ];

    $response = [
        'status' => 200,
        'url' => 'resetpassword'
    ];

} else {
    $response = [
        'status' => 400,
        'message' => $reset['message']
    ];
}

print_j($response);

// send a verification code
// redirect to verification page