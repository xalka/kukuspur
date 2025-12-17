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
    'action' => 3
];

if(isset($_GET['customerId']) && !empty($_GET['customerId'])) $dbdata['customerId'] = validInt($_GET['customerId']);
if(isset($_GET['phone']) && !empty($_GET['phone'])) $dbdata['phone'] = validPhone($_GET['phone']);
if(isset($_GET['email']) && !empty($_GET['email'])) $dbdata['email'] = validEmail($_GET['email']);
if(isset($_GET['active']) && !empty($_GET['active'])) $dbdata['active'] = validInt($_GET['active']);
if(isset($_GET['verified']) && !empty($_GET['verified'])) $dbdata['verified'] = validInt($_GET['verified']);

try {
    $response = PROC(CUSTOMER($dbdata)); //[0][0];
    
    // $response = $customer;

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);