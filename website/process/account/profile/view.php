<?php

if(ReqPost()){
    // validate 

    $_POST['customerId'] = base64_decode($sess['id']);
    $updated = json_decode(callAPI('POST','customer/v1/update',$_POST, $headers),1);

    print_j($updated);


} elseif(ReqGet()){
    $request = [
        'customerId' => base64_decode($sess['id'])
    ];
    
    $data = [
        'customer' => json_decode(callAPI('GET', 'customer/v1/view', $request, $headers),1),
        'categories' => json_decode(callAPI('GET', 'category/v1/view', [], $headers),1)
    ];
    if(isset($data['customer'][0][0])) $data['customer'] = $data['customer'][0][0];
    
    require BASE_DIR.'layout/account/profile/view.php';



} else ReqBad();