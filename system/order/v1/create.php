<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.procedures.php';
require __dir__.'/../../.core/.mysql.php'; 

// POST request only
if(!ReqPost()) ReqBad();

$headers = getallheaders();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

$dbdata = [
    'action' => 5,
    'customerId' => $req['customerId'],
    'modeId' => $req['modeId'],
    'addressId' => $req['addressId'],
    'shipping' => 150
];
$order = PROC(Order($dbdata))[0][0];

if($order['created']){
    $response = [
        'status' => 201,
        'orderId' => $order['orderId']
    ];
} else {
    $response = [
        'status' => 400,
        'message' => $order['message']
    ];    
}

exit(print_j($response));