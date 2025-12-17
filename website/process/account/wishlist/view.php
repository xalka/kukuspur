<?php

$request = [
    'customerId' => base64_decode($sess['id'])
];

$data = [
    'items' => json_decode(callAPI('GET', '/cart/v1/view', $request, $headers),1),
    'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
];

require BASE_DIR.'layout/account/wishlist/view.php';