<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

if(!ReqGet()) ReqBad();

// 1. Receive json
// $req = json_decode(file_get_contents('php://input'),1);

// 2. Validate
$dbdata = [
    'action' => 4,
    // 'active' => 1
];

if(!isset($_GET['id']) && empty($_GET['id'])) ReqBad();

$dbdata['productId'] = validInt($_GET['id']);

try {
    $response = PROC(Product($dbdata)); // [0]; // [0];
    // print_r($response); exit;

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);