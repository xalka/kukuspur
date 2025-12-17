<?php

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

Authentication();

$sess = $_SESSION[SESSION_KEY];

$headers = [
    'customerId: '.base64_decode($sess['id']),
    // 'typeId: '.$sess['typeId']
];

$mod = isset($_GET['view']) ? validString($_GET['view']) : 'dashboard';
$file = isset($_GET['action']) ? validString($_GET['action']) : 'view';

require BASE_DIR.'process/account/'.$mod.'/'.$file.'.php';