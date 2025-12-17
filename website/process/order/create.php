<?php

// validate request

$_POST['customerId'] = base64_decode($_SESSION[SESSION_KEY]['id']);

$order = json_decode(callAPI('POST','order/v1/create',$_POST, $headers),1);
if($order['status'] != 201){
    print_j($order);
    exit;
}

unset($_SESSION['cart']);

$order['addressId'] = $_POST['addressId'];
$order['modeId'] = $_POST['modeId'];
$order['url'] = '/order?action=payment&modeId='.$order['modeId'].'&orderId='.$order['orderId'];

print_j($order);

// redirect to payment mode page