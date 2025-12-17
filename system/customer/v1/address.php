<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.procedures.php';
require __dir__.'/../../.core/.mysql.php'; 

$headers = getallheaders();

if(ReqPost()):
    // 1. Receive json
    $req = json_decode(file_get_contents('php://input'),1); 

    // 2. Validate

    $dbdata = [
        'action' => 7,
        'customerId' => $req['customerId'],
        'fname' => $req['fname'],
        'lname' => $req['lname'],
        'phone' => validPhone($req['phone']),
        'email' => validEmail($req['email']),
        'active' => $req['defaultAddress'] ?? 0,
        "locale" => $req['locale'],
        "latitude" => $req['latitude'],
        "longitude" => $req['longitude']
    ];
    
    $return = PROC(CUSTOMER($dbdata))[0][0];
    if($return['created']){
        $response = [
            'status' => 200,
            'addressId' => $return['id'],
            'message' => 'Address created'
        ];
        exit(print_j($response));
    } else {
        $response = [
            'status' => 400,
            'message' => 'Failed to create address'
        ];
        exit(print_j($response));        
    }

elseif(ReqPut()):
    // 1. Receive json
    $req = json_decode(file_get_contents('php://input'),1); 

    // 2. Validate
    print_r($req);

elseif(ReqGet()):
    // 1. Receive $_GET
    $dbdata = [
        'action' => 8,
        'customerId' => validInt($_GET['customerId'])
    ];
    if(isset($_GET['default']) && !empty($_GET['default'])) $dbdata['active'] = 1;
    
    $return = PROC(CUSTOMER($dbdata))[0];
    exit(print_j($return));
    
else:
    ReqBad();
endif;