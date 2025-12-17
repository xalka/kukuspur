<?php

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Africa/Nairobi');

define('TIMESTAMP',date('YmdHis'));
define('NOW',date('Y-m-d H:i:s'));
define('DEFAULTDATE','0000-00-00');

define('API_HOST','http://127.0.0.1:3004/');

define('DIRECT_ACCESS',true);

define('LOG_FILE','/tmp/'.date('Y-m-d').'-kukuspur.log');
define('LOG_MPESA','/tmp/'.date('Y-m-d').'-kukuspur-mpesa.log');
define('LOG_FILE_REDIS','/tmp/'.date('Y-m-d').'-kukuspur-redis.log');

define('SESSION_KEY','$oLrxvf8/mDKUN0923kd23deMRA1zT/sWd4/fsmxjFBIJmZmjLrxvf8.4y./amp/mDKUNeMRA1zT/sWd4/fsmxjFBIJmZmjtaI1pmtaI1pm$8dTlRwAFqmMzNoqJkmrJb.GFGVLeok6w810rX0VLDGjodkm2/ajHi');
define('START',0);
define('LIMIT',40);

// production
// error_reporting(-1);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

define('DB','kukuspur');
define('DB_HOST','127.0.0.1');
define('DB_PORT',3306);
define('DB_USER','root');
define('DB_PASS','NOV.2014.TEN');
define('DB_CHARSET','utf8');

define('PASSWORD_KEY','GFGVLeok6w810srX0VLDGjodk44mMzNoqJkmrJb.GFGVLeok6w810rX0VLDGjodm2');

define('REDIS_HOST', '127.0.0.1');
define('REDIS_PORT', 6379);
define('REDIS_USER', '');
define('REDIS_PASS', 'BlueBand23');

define('KAFKA_BROKER', 'localhost:9092');
define('KAFKA_SEND_BULK_TOPIC', 'sendbulksms');

// Not in use

define('SMS_BUSINESSID',1);
define('SMS_USERNAME','techxal');
define('SMS_SHORTCODE','TECHXAL');
define('SMS_TOKEN','64f1e9b145c93401693575601306208169357560160EC92146E3AF82C4D3B78A03DEE33BC1693575601156933');

define('EMAIL_ENDPOINT',"https://www.techxal.com/sendemail.php");
// define('EMAIL_ENDPOINT',"http://127.0.0.1:1802/email/v1/sendemail.php");
define('SMSENDPOINT','https://internal.api.techxal.co.ke/sms/v1/senddirectly');
define('WEBDOMAIN','https://kukuspur.techxal.co.ke');