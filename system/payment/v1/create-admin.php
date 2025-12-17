<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
// require __dir__.'/../../.config/.mongodb.php';
require __dir__.'/../../.core/.procedures.php';

// POST request only
if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

$headers = getallheaders();

$dbdata = [
    'action' => 12,
    'rate' => $req['rate'],
    'amount' => validInt($req['amount']),
    'adminId' => validInt($headers['Adminid']),
    'reference' => validString($req['reference']),
    'groupId' => validInt($req['groupId']),
    'modeId' => validInt($req['modeId']),
    'statusId' => 3
];

try {
    // 2. save the request into database
    $return = PROC(PAYMENT($dbdata));

    if(!empty($return) && $return[0][0]['created']){
        $response = [
            'status' => 201, 
            'paymentId' => $return[0][0]['id']
        ]; 
    } else {
        $response = [
            'status' => 401,
            'error' => 'Unable to create payment'
        ];
    }
    

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

// 7. Respond with a json
print_j($response);