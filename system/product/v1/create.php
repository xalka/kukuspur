<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

// print_r($req); exit;

$dbdata = [
    'action'      => 1,
    // 'productId'   => $req['productId'],
    'product'     => $req['product'],
    'descrp'      => $req['descrp'],
    'seo_title'   => $req['seo_title'],
    'meta_descrp' => $req['meta_descrp'],
    'categoryId'  => $req['categoryId'],
    'viewId'      => $req['viewId'],
    'sku'         => $req['sku'],
    'imgs'        => json_encode($req['imgs']),
    'customerId'  => $req['customerId'],
    // 'adminId'     => $req['adminId'],
    'statusId'    => $req['statusId'],
    'price'       => $req['price'],
    'discount'    => $req['discount'] ?? 0,
    'tax'         => $req['tax'] ?? 0,
    'cstock'      => $req['stock'] ?? 0
];

try {
    $response = PROC(Product($dbdata))[0][0]; // [0]; // [0];
    if($response['created']) {
        $response = [
            'status' => 200
        ];
    } else {
        $response = [
            'status' => 401,
            'error' => $response['error'] ?? 'Technical problem'
        ];
    }

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);