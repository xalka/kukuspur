<?php

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

// isLoggedIn();

// authenticate($_SERVER['REQUEST_URI']);

$sess = $_SESSION[SESSION_KEY];

$headers = [
    // 'UserId: '.base64_decode($sess['userId']),
    // 'SaccoId: '.$sess['saccoId']
];

// print_r($_SESSION['cart']); exit;

if(ReqGet()) require BASE_DIR.'process/pages/home.php';

else ReqBad();