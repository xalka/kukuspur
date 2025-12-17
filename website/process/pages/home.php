<?php

// $sess = $_SESSION[SESSION_KEY];
// $groupId = base64_decode($sess['groups']); // revisit when having more than one group
// $customerId = base64_decode($sess['id']);

// $headers = [
//     'groupId: '.$groupId,
//     'customerId: '.$customerId
// ];

$request = [
    'page' => 0,
    'limit' => 5,
    'viewId' => $sess['typeId']
];

$data = [
    'products' => 
        [ 'featured' => json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1) ],
        // [ 'best' => json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1) ],
        // [ 'farm' => json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1) ],
    'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
];

$request = [
    'categoryId' => 14,
    'page' => 0,
    'limit' => 5
];
$data['products']['best'] = json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1);

$request = [
    'categoryId' => 3,
    'page' => 0,
    'limit' => 5
];
$data['products']['farm'] = json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1);

require BASE_DIR.'layout/pages/home.php';