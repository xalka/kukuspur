<?php

// $sess = $_SESSION[SESSION_KEY];
// $groupId = base64_decode($sess['groups']); // revisit when having more than one group
// $customerId = base64_decode($sess['id']);

// $headers = [
//     'groupId: '.$groupId,
//     'customerId: '.$customerId
// ];

$request = [
    'id' => $_GET['id'],
];

$product = json_decode(callAPI('GET', 'product/v1/detail', $request, $headers),1);
// echo "<pre>"; print_r($product); exit;
$data = [
    'product' =>  [
        'detail' => $product[0][0],
        'images' => $product[1]
    ],
    'categories' => json_decode(callAPI('GET', 'category/v1/view', [], $headers),1),
    'cart' => $_SESSION['cart']
];

$request = [
    'categoryId' => $product[0][0]['categoryId'],
    'limit' => 5
];

$data['related'] = json_decode(callAPI('GET', 'product/v1/view', $request, $headers),1);

require BASE_DIR.'layout/pages/product.php';