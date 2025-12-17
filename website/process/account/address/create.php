<?php

$customerId = base64_decode($sess['id']);

if(ReqGet()) {

    $request = [
        'customerId' => $customerId
    ];

    $data = [
        'addresses' => json_decode(callAPI('GET', '/customer/v1/address', $request, $headers),1),
        'categories' => json_decode(callAPI('GET', '/category/v1/view', [], $headers),1)
    ];

    require BASE_DIR.'layout/account/address/create.php';

} elseif(ReqPost()){

    // validate

    $_POST['customerId'] = $customerId;
    $_POST['defaultAddress'] = $_POST['default'] == 'on' ? 1 : 0;

    $address = json_decode(callAPI('POST', '/customer/v1/address', $_POST, $headers),1);
    
    if($address['status'] == 200){
        $response = [
            'status' => 200,
            'url' => 'account?view=address'
        ];
    } else {
        $response = [
            'status' => 400,
            'url' => 'unable to create the address'
        ];
    }


    print_j($response);

}