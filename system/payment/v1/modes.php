<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.procedures.php';
require __dir__.'/../../.core/.mysql.php'; 

if(!ReqGet()) ReqBad();

$dbdata = [
    'action' => 1
];

print_j(PROC(PAYMENT($dbdata))[0]); // [0][0]; // print_r($return1); exit;