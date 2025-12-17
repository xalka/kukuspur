<?php

$request = [
    'page' => 0,
    'limit' => 12
];

$data = [
    'products' => json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1),
    'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
];

$request = [ 'id' => 14 ];
$data['cat14'] = json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1);

require BASE_DIR.'layout/account/dashboard.php';