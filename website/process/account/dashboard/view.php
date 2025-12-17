<?php

$request = [
    'page' => 0,
    'limit' => 12
];

$data = [
    'customerType' => $sess['typeId'],
    // 'products' => json_decode(callAPI('GET', 'product/v1/view', $request, $headers),1),
    'categories' => json_decode(callAPI('GET', 'category/v1/view', [], $headers),1)
];

// get recent orders
$request = [
    'customerId' => base64_decode($sess['id']),
    'page' => 0,
    'limit' => 5
];
$data['orders'] = json_decode(callAPI('GET', 'order/v1/view', $request, $headers),1);
$data['payments'] = json_decode(callAPI('GET', 'payment/v1/view', $request, $headers),1);

require BASE_DIR.'layout/account/dashboard.php';