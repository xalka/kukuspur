<?php

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

Authentication();

// authenticate($_SERVER['REQUEST_URI']);

// $sess = $_SESSION[SESSION_KEY];

$headers = [
    // 'UserId: '.base64_decode($sess['userId']),
    // 'SaccoId: '.$sess['saccoId']
];

if(ReqGet()){

    $data = [
        'types' => json_decode(callAPI('GET', '/customer/v1/type', null, $headers),1),
        'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
    ];  

    require BASE_DIR.'layout/auth/login.php';

} elseif(ReqPost()) require BASE_DIR.'process/auth/login.php';