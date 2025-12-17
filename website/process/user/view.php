<?php

// $sess = $_SESSION[SESSION_KEY];
// $groupId = base64_decode($sess['groups']); // revisit when having more than one group
// $customerId = base64_decode($sess['id']);

// $headers = [
//     'groupId: '.$groupId,
//     'customerId: '.$customerId
// ];

$request = [
    // 'phone' => $_POST['phone'],
    // 'amount' => $_POST['amount'],
    // 'groupId' => $groupId,
    // 'customerId' => $customerId
];

$data['users'] = json_decode(callAPI('GET','/customer/v1/view',$request, $headers),1);

require BASE_DIR.'layout/user/view.php';