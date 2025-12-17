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
// print_j($req); exit;

$dbdata = [
    'action' => 1,
    'customerId' => $headers['Customerid']
];
$cart = PROC(Order($dbdata))[0][0];

foreach ($req as $key => $value) { // print_j($value); exit;
    $dbdata = [
        'action' => 2,
        'cartId' => $cart['cartId'],
        'productId' => $value['productId'],
        'qty' => $value['qty'],
        'price' => $value['price'],
        'discount' => $value['discount'],
        'tax' => $value['tax']
    ];
   //  print_j($dbdata); exit;
    $item = PROC(Order($dbdata));
    // print_j($item);
}

$response = [
    'status' => 201
];

exit(print_j($response));