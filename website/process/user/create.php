<?php

// print_r($_POST); exit;

// validate phone & amount

// {
//     "phone" : 254715003414,
//     "amount" : 1,
//     "groupId" : 1,
//     "customerId" : 1
// }

// The account should be corporate

// $sess = $_SESSION[SESSION_KEY];
// $groupId = base64_decode($sess['groups']); // revisit when having more than one group
// $customerId = base64_decode($sess['id']);

// $headers = [
//     'groupId: '.$groupId,
//     'adminId: '.$customerId
// ];

// validate 
// $_POST

// print_r($_POST);
// print_r($headers);
// exit;

$user = json_decode(callAPI('POST','customer/v1/create',$_POST, $headers),1);

print_j($user);