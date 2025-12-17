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
    'categoryId' => validInt($_GET['id'])
];

if(!isset($_GET['id']) && empty($_GET['id'])) ReqBad();

$dbdata['start'] = validInt($_GET['page'] ?? 0)*validInt($_GET['limit'] ?? 10);
$dbdata['limit'] = validInt($_GET['limit'] ?? 10);

try {
    $response = PROC(Product($dbdata))[0];

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);