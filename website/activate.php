<?php

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

Authentication();

if(ReqGet()){
    $data = [
        'categories' => json_decode(callAPI('GET', '/category/v1/view', [], []),1)
    ];  
    require BASE_DIR.'layout/auth/activate.php';
} 

elseif(ReqPost()) require BASE_DIR.'process/auth/activate.php';