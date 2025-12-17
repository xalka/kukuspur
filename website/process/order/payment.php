<?php

$orderId = validInt($_GET['orderId']);
$customerId = base64_decode($sess['id']);

if(ReqGet()){

    $request = [
        'customerId' => $customerId,
        'orderId' => $orderId
    ];
    $data = [
        'order' => json_decode(callAPI('GET', 'order/v1/details', $request, $headers),1),
        'categories' => json_decode(callAPI('GET', 'category/v1/view', [], $headers),1)
    ];

    // echo "<pre>"; print_r($data); exit;

    require BASE_DIR.'layout/cart/payment.php';

} elseif(ReqPost()){

    $_POST['orderId'] = $orderId;
    $_POST['customerId'] = $customerId;
    $_POST['phone'] = validPhone($_POST['phone']);
    $_POST['amount'] = ceil($_POST['amount']);

    // validate
    $payment = json_decode(callAPI('POST', 'payment/v1/create', $_POST, $headers),1);

    print_j($payment);

} else ReqBad();