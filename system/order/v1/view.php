<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.procedures.php';
require __dir__.'/../../.core/.mysql.php'; 

// POST request only
if(!ReqGet()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

// 2. Validate
$dbdata = [
    'action' => 7,
    'start' => isset($_GET['start']) ? $_GET['start'] : START,
    'limit' => isset($_GET['limit']) ? $_GET['limit'] : LIMIT,
    'orderId' => isset($_GET['orderId']) ? $_GET['orderId'] : null,
    'customerId' => isset($_GET['customerId']) ? $_GET['customerId'] : null
];

try {
    $response = PROC(ORDER($dbdata))[0]; // [0];

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);