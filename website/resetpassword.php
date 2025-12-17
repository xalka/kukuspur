<?php

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

Authentication();

// $sess = $_SESSION[SESSION_KEY];

$headers = [
    // 'UserId: '.base64_decode($sess['userId']),
    // 'SaccoId: '.$sess['saccoId']
];

if(ReqGet()){
    $data = [
        'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
    ];      
    require BASE_DIR.'layout/auth/resetpassword.php';
}

elseif(ReqPost()) require BASE_DIR.'process/auth/resetpassword.php';