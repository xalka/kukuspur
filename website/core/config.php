<?php
// exit(__dir__.'/..');
define('BASE_DIR',__dir__.'/../');
define('API_HOST','http://127.0.0.1:2601/');
// define('API_HOST','https://api.techpitch.techxal.co.ke/');
define('SESSION_KEY','mDKUNeMRA1zT/sWd4/fsmxjFRA1zT/sWd4/$8dTlRwAFqmMzNoqJkmrJb.GFGVLeok6w810rX0VLDGjodkm2/ajHi');
define('PASSWORD_KEY','GFGVLeok6w810rX0VLDGjodkm2');
define('FILE_MAX_SIZE',(1*1024*1024*1024)); // 1GB in bytes');
define('GOOGLE_PLACE_API','https://maps.googleapis.com/maps/api/place/autocomplete/json?input=');
define('GOOGLE_PLACE_KEY','AIzaSyDIbVgQ4z_O8B-HEbC39DjAuRxej69Nr_w');

session_start();

if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];