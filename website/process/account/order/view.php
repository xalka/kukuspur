<?php

$request = [
    'customerId' => base64_decode($sess['id'])
];

$data = [
    'orders' => json_decode(callAPI('GET', 'order/v1/view', $request, $headers),1),
    'categories' => json_decode(callAPI('GET', 'category/v1/view', [], $headers),1)
];

require BASE_DIR.'layout/account/order/view.php';