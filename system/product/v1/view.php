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
    'action' => 3,
    // 'active' => 1
];

// $dbdata['start'] = validInt($_GET['page'] ?? 0)*validInt($_GET['limit'] ?? 10);
$dbdata['limit'] = validInt($_GET['limit'] ?? 10);

if(isset($_GET['viewId'])) $dbdata['viewId'] = validInt($_GET['viewId'] ?? null);
if(isset($_GET['longitude'])) $dbdata['longitude'] = $_GET['longitude'] ?? null;
if(isset($_GET['latitude'])) $dbdata['latitude'] = $_GET['latitude'] ?? null;

if(isset($_GET['owner']) && $_GET['owner']==1 && isset($_GET['customerId'])){
    $dbdata['customerId'] = validInt($_GET['customerId'] ?? null);
    $dbdata['action'] = 5;
}

if(isset($_GET['categoryId'])) $dbdata['categoryId'] = validInt($_GET['categoryId']);

try {
    $response = PROC(Product($dbdata))[0]; // [0];
    // print_r($response);

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);