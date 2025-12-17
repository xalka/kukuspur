<?php

$request = [
    'customerId' => base64_decode($sess['id'])
];

$data = [
    'addresses' => json_decode(callAPI('GET', '/customer/v1/address', $request, $headers),1),
    'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
];

require BASE_DIR.'layout/account/address/view.php';