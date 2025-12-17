<?php

// validate request
$productId = validInt($_POST['productId']);

$request = [
    'id' => $productId
];

// get product details
$product = json_decode(callAPI('GET','/product/v1/detail',$request, $headers),1);

$qty = validInt($_POST['qty']);

if($qty == 0){
    unset($_SESSION['cart'][$productId]);
    // if loggedin, remove from db

    $response = [
        'status' => 201,
        'message' => 'Product remove from cart quantity'
    ];
    
} else {

    if($qty > $product[0][0]['stock']) {
        $response = [
            'status' => 400,
            'message' => 'Product out of stock'
        ];
        
    } else {

        // if loggged into insert or update cart
        
        $_SESSION['cart'][$productId] = [
            'productId' => $productId,
            'product' => $product[0][0]['product'],
            'qty' => validInt($_POST['qty']),
            'stock' => $product[0][0]['stock'],
            'price' => $product[0][0]['price'],
            'discount' => $product[0][0]['discount'],
            'tax' => $product[0][0]['tax'],
            'img' => $product[1][0]['img'],
            'created' => time()
        ];

        $response = [
            'status' => 201,
            'message' => 'Product added to cart'
        ];

    }

}

$response['cartCount'] = array_sum(array_column($_SESSION['cart'],'qty'));

print_j($response);