<?php

// define('BASE_DIR',__dir__.'/../');

define('SESSION_KEY', 'author_'.hash('sha256','babutalk@2025'));

// terminal [ openssl rand -hex 32 ]
// define('PASSWORD_KEY','c90a07a0aba330c9e2fc355aa1f79961c36331e8355109d4ab31bd012aa07e56'); 

// define('FILE_MAX_SIZE',(1*1024*1024*1024)); // 1GB in bytes');
define('IMG_MAX_SIZE',(5*1024*1024)); // 5MB in bytes');
define('IMAGES_DIR',__dir__.'/../public/images/');

define('DB','kukuspur');
define('DB_HOST','127.0.0.1');
define('DB_PORT',3306);
define('DB_USER','root');
define('DB_PASS','NOV.2014.TEN');
define('DB_CHARSET','utf8');
define('START',0);
define('LIMIT',15);

define('NOW',date('Y-m-d H:i:s'));

define('LOG_FILE','/tmp/'.date('Y-m-d').'-kukuspur.log');
define('EMAIL_ENDPOINT','https://www.techxal.com/sendemail.php');

define('LOGO','http://127.0.0.1:3003/public/images/babutalk.jpeg');

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}