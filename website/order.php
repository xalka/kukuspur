<?php

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

Authentication();

$sess = $_SESSION[SESSION_KEY];
$headers = [
    'customerId: '.base64_decode($sess['id']),
    'typeId: '.$sess['typeId']
];

$file = isset($_GET['action']) ? validString($_GET['action']) : 'dashboard';

require BASE_DIR.'process/order/'.$file.'.php';

exit;

switch ($_GET['action'] ?? null) {
    case 'create':
        require BASE_DIR.'process/order/create.php';
        break;

    case 'modify':
        require BASE_DIR.'process/order/modifier.php';
        break;

    case 'product':
        require BASE_DIR.'process/order/product.php';
        break;

    case 'messages':
        require BASE_DIR.'process/order/messages.php';
        break;

    case 'payment':
        require BASE_DIR.'process/order/payment.php';
        break;

    default:
        require BASE_DIR.'process/order/shopping.php';
        break;
}