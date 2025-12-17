<?php

$request = [
    // 'phone' => $_POST['phone'],
    // 'amount' => $_POST['amount'],
    // 'groupId' => $groupId,
    // 'customerId' => $customerId
];

$data['dlr'] = json_decode(callAPI('GET','message/v1/dlr',$request, $headers),1);
// echo "<pre>"; print_r($data); exit;

require BASE_DIR.'layout/report/dlr.php';