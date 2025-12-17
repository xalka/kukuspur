<?php

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

// Authentication();

if(isset($_SESSION[SESSION_KEY])){
    $sess = $_SESSION[SESSION_KEY];
    $headers = [
        'customerId: '.base64_decode($sess['id']),
        'typeId: '.$sess['typeId']
    ];
}

switch ($_GET['action'] ?? null) {
    case 'modify':
        require BASE_DIR.'process/cart/modifier.php';
        break;

    case 'product':
        require BASE_DIR.'process/cart/product.php';
        break;

    case 'messages':
        require BASE_DIR.'process/cart/messages.php';
        break;

    default:
        require BASE_DIR.'process/cart/shopping.php';
        break;
}