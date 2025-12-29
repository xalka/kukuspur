<?php

// define('BASE_DIR',__dir__.'/../');

define('SESSION_KEY', 'caa5e72238500f9a4fa6873a2c9755588a280baf8e9e61351e5c3069'.hash('sha256','b2f1db9e9bfa47354d4a5cf802bf38447af23b260282c4bb6be9984cd71c2b4c'));

// terminal [ openssl rand -hex 32 ]
define('PASSWORD_KEY','0048b99ce04374'); 

define('FILE_MAX_SIZE',(1*1024*1024*1024)); // 1GB in bytes');
define('IMG_MAX_SIZE',(1*1024*1024)); // 1MB in bytes');

define('DB','kukuspur');
define('DB_HOST','127.0.0.1');
define('DB_PORT',3306);
define('DB_USER','root');
define('DB_PASS','NOV.2014.TEN');
define('DB_CHARSET','utf8');
define('START',0);
define('LIMIT',15);

define('MPESA_KEY','GolEqdUlOS7CAzNrT0CzGXXfl8bRoepP');
define('MPESA_SECRET','0L9HP57UE6KPtLCc');
define('MPESA_PASSKEY','7d547f9e6424a35d2000d8db2e586b0ef187cef8ea181bcb342d8b1fff590577');
define('MPESA_SHORTCODE',594831);
define('MPESA_CALLBACK', 'https://3fd606a679b3a5da2bfcf898541c1308a1771e10449121091fb141ed48c8.techxal.co.ke/');
// define('MPESA_CALLBACK', 'https://a3a222056e83.ngrok-free.app/');
define('MPESA_API', 'https://api.safaricom.co.ke/');
define('TIMESTAMP',date('YmdHis'));

define('NOW',date('Y-m-d H:i:s'));

define('LOG_FILE','/tmp/'.date('Y-m-d').'-kukuspur-website.log');

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}