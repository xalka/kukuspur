<?php

// $sess = $_SESSION[SESSION_KEY];
// $groupId = base64_decode($sess['groups']); // revisit when having more than one group
// $customerId = base64_decode($sess['id']);

// $headers = [
//     'groupId: '.$groupId,
//     'customerId: '.$customerId
// ];

$request = [];
$data['categories'] = json_decode(callAPI('GET', '/category/v1/view', $request, $headers),1);

$request = [
    'id' => $_GET['id'],
    'page' => 0,
    'limit' => 12    
];
$data['products'] = json_decode(callAPI('GET', '/product/v1/category', $request, $headers),1);

$request = [
    'page' => 0,
    'limit' => 5
];
$data['history'] = json_decode(callAPI('GET', '/product/v1/view', $request, $headers),1);

require BASE_DIR.'layout/pages/account.php';