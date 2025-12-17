<?php

// validate request
$productId = validInt($_POST['productId']);

$request = [
    'id' => $productId
];

// get product details
$product = json_decode(callAPI('GET','product/v1/detail',$request, $headers),1);
// print_r($product); exit;
$qty = validInt($_POST['qty']);

if($qty == 0){
    unset($_SESSION['cart'][$productId]);
    // if loggedin, remove from db

    $response = [
        'status' => 201,
        'message' => 'Product remove from cart quantity'
    ];
    
} else {

    $product = $product[0][0];

    if($qty > $product['stock']) {
        $response = [
            'status' => 400,
            'message' => 'Product out of stock'
        ];
        
    } else {

        // if loggged into insert or update cart
        if(isset($_SESSION[SESSION_KEY]) && $_SESSION[SESSION_KEY]['auth'] == 1){
            $dbdata[] = [
                'productId' => $productId,
                'qty' => validInt($_POST['qty']),
                'stock' => $product['stock'],
                'price' => $product['price'],
                'discount' => $product['discount'],
                'tax' => $product['tax'],
                'customerId' => base64_decode($_SESSION[SESSION_KEY]['id']),
            ];
            
            $cart = json_decode(callAPI('POST', 'cart/v1/create', $dbdata, $headers),1);
        } 
        
        $_SESSION['cart'][$productId] = [
            'productId' => $productId,
            'product' => $product['product'],
            'qty' => validInt($_POST['qty']),
            'stock' => $product['stock'],
            'price' => $product['price'],
            'discount' => $product['discount'],
            'tax' => $product['tax'],
            'img' => $product['img'],
            'created' => time()
        ];

        $response = [
            'status' => 201,
            'message' => 'Product added to cart'
        ];
        
        $response['cartCount'] = array_sum(array_column($_SESSION['cart'],'qty'));
    }

}



print_j($response);