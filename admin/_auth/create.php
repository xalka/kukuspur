<?php

if(ReqPost()){

    csrfToken();

    $dbData = [
        'action' => 2,
        'phone' => validPhone($_POST['phone']),
        'email' => validEmail($_POST['email']),
        'fname' => validString($_POST['fname']),
        // 'lname' => validString($_POST['lname']),
        'code' => intRand(),
        'pass' => passEncrype($_POST['pass']),
    ];
    
    if(!validPhone($_POST['phone']) or !validEmail($_POST['email'])){
        exit(print_j([
            'status' => 400,
            'message' => 'Invalid email or phone number'
        ]));
    };

    $return = Proc(Author($dbData));

    if(!empty($return) && isset($return[0][0]['created'])){
        $return = $return[0][0];

        // set session for verifying the account

        $response = [
            'status' => 200,
            'url' => '/auth', // '/auth?action=verify',
            'message' => 'Registered successful'
        ];
    
    } else {
        $response = [
            'status' => 400,
            'message' => 'Register failed'
        ];         
    }

    exit(print_j($response));

} else ReqBad();