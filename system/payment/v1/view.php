<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

// GET request only
if(!ReqGet()) ReqBad();

$headers = getallheaders();
// 2. validate

// 3. read from mysql
$dbdata = [
    'action' => 6,
    'limit' => isset($_GET['limit']) ? validInt($_GET['limit']) : LIMIT
];

if(isset($_GET['paymentId'])) $dbdata['paymentId'] = validInt($_GET['paymentId']);

if(isset($_GET['customerId'])) $dbdata['customerId'] = validInt($_GET['customerId']);


$payments = PROC(PAYMENT($dbdata));

if(!empty($payments)) $payments = $payments[0];

$payments = array_map(function($payment) {
    $timestamp = strtotime($payment['created']);
    $payment['date'] = date('Y-M-d', $timestamp);
    $payment['time'] = date('H:i', $timestamp);
    return $payment;
}, $payments);


print_j($payments);