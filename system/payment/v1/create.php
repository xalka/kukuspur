<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

// POST request only
if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

$headers = getallheaders();

$dbdata = [
    'action' => 2,
    'phone' => validPhone($req['phone']),
    'amount' => validInt($req['amount']),
    'orderId' => validInt($req['orderId']),
    // 'adminId' => validInt($req['customerId']),
    'customerId' => validInt($req['customerId']),
    // 'adminId' => validInt($headers['Customerid']),
    // 'customerId' => validInt($headers['Customerid']),
    // 'MerchantRequestID' => validString($req['MerchantRequestID']),
    // 'CheckoutRequestID' => validString($req['CheckoutRequestID']),
    // 'description' => validString($req['description']),
    // 'CustomerMessage' => validString($req['CustomerMessage']),
    'modeId' => 1,
    'statusId' => 1
];

try {
    // 2. save the request into database
    $return1 = PROC(PAYMENT($dbdata))[0][0]; // print_r($return1); exit;
    if(isset($return1['created']) && $return1['created']==0){
        $response = [
            'status' => 401,
            'error' => 'Technical Error'
        ];  
        exit(print_j($response));        
    }

    $paymentId = $return1['id'];

    $request = [
        "phone" => $dbdata['phone'],
        "amount" => $dbdata['amount'],
        "reference" => $paymentId,
        "transactionId" => $paymentId,
        "descrp" => "Order Payment"
    ];

    // 3. initiate mpesa payment [ /mpesa/v1/stkpush ]
    $url = API_HOST.'mpesa/v1/stkpush';
    $daraja = json_decode(callAPI('POST',$url,$headers,$request),1);
    
    // 4. update the response from daraja
    if(isset($daraja['ResponseCode']) && (int)$daraja['ResponseCode']==0){
        $dbdata = [
            'action' => 3,
            'paymentId' => $paymentId,
            'MerchantRequestID' => validString($daraja['MerchantRequestID']),
            'CheckoutRequestID' => validString($daraja['CheckoutRequestID']),
            'description' => $request['descrp'],
            'statusId' => 2
        ];

        $response['confirm'] = 1;

    } else {
        $dbdata = [
            'action' => 3,
            'paymentId' => $paymentId,
            // 'MerchantRequestID' => validString($daraja['MerchantRequestID']),
            // 'CheckoutRequestID' => validString($daraja['CheckoutRequestID']),
            'description' => $request['descrp'],
            'statusId' => 4
        ];
    }

    // print_j($dbdata); exit;
    $return2 = PROC(PAYMENT($dbdata)); // [0][0];
    // print_r($return2); exit;

    if(!isset($return2[0][0]['updated']) && $return2[0][0]['updated']!=1){
        $response = [
            'status' => 401,
            'error' => 'Technical Error'
        ];
        exit(print_j($response));
    }

    $response['status'] = 201;
    // $response['paymentId'] = $paymentId;
    // $response['MerchantRequestID'] = $daraja['MerchantRequestID'];
    // $response['CheckoutRequestID'] = $daraja['CheckoutRequestID'];
    // $response['description'] = $request['descrp'];
    $response['statusId'] = 2;
    
    // $response = $daraja;
    

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

// 7. Respond with a json
print_j($response);