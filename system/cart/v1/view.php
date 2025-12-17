<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

if(!ReqGet()) ReqBad();

$headers = getallheaders();

// 1. Receive json
// $req = json_decode(file_get_contents('php://input'),1);

// 2. Validate
$dbdata = [
    'action' => 3,
    // 'cartId' => $_GET['id'],
    'customerId' => $_GET['customerId'],
];
$items = PROC(Order($dbdata))[0];

print_j($items);