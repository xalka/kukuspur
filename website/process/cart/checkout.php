<?php

// if not logged in, redirect to login page, after login, redirect to checkout page

if(!isset($_SESSION[SESSION_KEY])){
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    header('Location: /login');
    exit;
}

// insert into db

if(isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_SESSION[SESSION_KEY]) && $_SESSION[SESSION_KEY]['auth'] == 1){
    // create cart
    // $dbdata = [ 'customerId' => base64_decode($sess['id']) ];
    
    foreach ($_SESSION['cart'] as $product) {
        $dbdata[] = [
            'productId' => $product['productId'],
            'qty' => $product['qty'],
            'stock' => $product['stock'],
            'price' => $product['price'],
            'discount' => $product['discount'],
            'tax' => $product['tax'],
            // 'customerId' => base64_decode($_SESSION[SESSION_KEY]['id']),
        ];
    }

    $cart = json_decode(callAPI('POST', 'cart/v1/create', $dbdata, $headers),1);

} else {
    // get cart from the database
}

$request = [
    'page' => 0,
    'limit' => 100
];

$data = [
    'modes' => json_decode(callAPI('GET', 'payment/v1/modes', $request, $headers),1),
    'categories' => json_decode(callAPI('GET', 'category/v1/view', $request, $headers),1),
    'items' => $_SESSION['cart']
];

// Integrate with delivery

$data['totals'] = cartSummary($data['items'],150); //  echo "<pre>"; print_r($data['totals']); exit;

$request = [
    'customerId' => base64_decode($_SESSION[SESSION_KEY]['id']),
    'default' => 1
];
$data['addresses'] = json_decode(callAPI('GET', '/customer/v1/address', $request, $headers),1)[0];

require BASE_DIR.'layout/cart/checkout.php';