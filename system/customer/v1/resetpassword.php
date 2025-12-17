<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

// 2. Validate

$dbdata = [
    'action' => 5,
    'active' => 1,
    'verified' => 1,
    'passreset' => 1,
    'code' => validInt($req['code']),
    'password' => passEncrype($req['password'])
];

if(isset($req['phone']) && !empty($req['phone'])){
    $dbdata['phone'] = validPhone($req['phone']);
} else {
    $dbdata['email'] = validEmail($req['email']);
}

try {
    $return = PROC(CUSTOMER($dbdata))[0][0];
    
    if($return['updated']==1){
        $response = [
            'status' => 200
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