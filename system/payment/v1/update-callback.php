<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
// require __dir__.'/../../.config/.mongodb.php';
require __dir__.'/../../.core/.procedures.php';

// POST request only
if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

$headers = getallheaders();

switch($req['action']){
    case 5:
        $dbdata = [
            'action' => 5,
            'amount' => $req['amount'],
            'reference' => $req['MpesaReceiptNumber'],
            'MerchantRequestID' => $req['MerchantRequestID'],
            'CheckoutRequestID' => $req['CheckoutRequestID'],
            'phone' => $req['PhoneNumber'],
            'thirdpartyTime' => date('Y-m-d H:i:s',strtotime($req['TransactionDate'])),
            'description' => $req['ResultDesc'],
            'statusId' => 3
        ];
        break;

    case 4:
        $dbdata = [
            'action' => 4,
            'paymentId' => $req['BillRefNumber'],
            'reference' => $req['TransID'], 
            'amount' => $req['TransAmount'],
            'fname' => $req['FirstName'],
            // 'mname' => $req['MiddleName'],
            // 'lname' => $req['LastName'],
            // 'phone' => $req['MSISDN'],
            'thirdpartyTime' => date('Y-m-d H:i:s',strtotime($req['TransTime'])),
            'statusId' => 3
        ];   
        break;

    case 6:
        $dbdata = [
            'action' => 7,
            'MerchantRequestID' => $req['MerchantRequestID'],
            'CheckoutRequestID' => $req['CheckoutRequestID'],
            'description' => $req['ResultDesc'],
            'statusId' => $req['statusId']
        ];   
        break;
    
    default:
        ReqBad();
        break;
}

try {
    // 2. update database with the callback, inside the procedure, calculate number of SMS
    // print_j($dbdata); exit;
    $response = PROC(Payment($dbdata));
    
    if(isset($response[0][0]['updated']) && $response[0][0]['updated'] == 1){
        $response = [
            'status' => 200
        ];
    } else {
        $response = [
            'status' => 400,
            'error' => 'Failed to update payment'
        ];        
    }

    /*$request = [
        "phone" => $dbdata['phone'],
        "amount" => $dbdata['amount'],
        "reference" => $return1['id'],
        "transactionId" => $return1['id'],
        "descrp" => "Payment for SMS"
    ];

    // 3. initiate mpesa payment [ /mpesa/v1/stkpush ]
    $url = API_HOST.'mpesa/v1/stkpush';
    $daraja = json_decode(callAPI('POST',$url,$headers,$request),1);

    // print_j($daraja); exit;
    
    // 4. update the response from daraja
    if(isset($daraja['ResponseCode']) && (int)$daraja['ResponseCode']==0){
        $dbdata = [
            'action' => 2,
            'paymentId' => $return1['id'],
            'MerchantRequestID' => validString($daraja['MerchantRequestID']),
            'CheckoutRequestID' => validString($daraja['CheckoutRequestID']),
            'description' => $request['descrp'],
            'statusId' => 2
        ];

    } else {
        $dbdata = [
            'action' => 2,
            'paymentId' => $return1['id'],
            // 'MerchantRequestID' => validString($daraja['MerchantRequestID']),
            // 'CheckoutRequestID' => validString($daraja['CheckoutRequestID']),
            'description' => $request['descrp'],
            'statusId' => 4
        ];
    }

    // print_j($dbdata); exit;
    $return2 = PROC(PAYMENT($dbdata));
    print_j($return2); exit;

    $response = $daraja;
    */    

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

// 7. Respond with a json
print_j($response);