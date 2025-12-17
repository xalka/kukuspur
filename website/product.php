<?php

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

// isLoggedIn();

// authenticate($_SERVER['REQUEST_URI']);

// $sess = $_SESSION[SESSION_KEY];

$headers = [
    // 'UserId: '.base64_decode($sess['userId']),
    // 'SaccoId: '.$sess['saccoId']
];

if(ReqGet()) require BASE_DIR.'process/pages/product.php';

else ReqBad();