<?php

$request = [
    'page' => 0,
    'limit' => 2000,
    'customerId' => base64_decode($sess['id']),
    // 'owner' => 1
];

$data = [
    'products' => json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1),
    'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
];

require BASE_DIR.'layout/account/product/view.php';