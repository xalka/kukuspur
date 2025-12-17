<?php

$sess = $_SESSION[SESSION_KEY];
$groupId = base64_decode($sess['groups']); // revisit when having more than one group
$customerId = base64_decode($sess['id']);

$headers = [
    'groupId: '.$groupId,
    'adminId: '.$customerId
];

$request = [
    // 'phone' => $_POST['phone'],
    // 'amount' => $_POST['amount'],
    'groupId' => $groupId,
    'customerId' => $customerId
];

// $payments = json_decode(callAPI('GET','payment/v1/view',$request, $headers),1);

require BASE_DIR.'layout/profile/view.php';