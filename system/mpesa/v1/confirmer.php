<?php

// Ensure whitelisting of mpesa ips

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php';

if(!ReqPost()) ReqBad();

$results = json_decode(file_get_contents('php://input'),1);

writeToFile(LOG_MPESA,json_encode($results));

if(isset($results['Body']) && isset($results['Body']['stkCallback']) && isset($results['Body']['stkCallback']['ResultCode'])):
    $stkCallback = $results['Body']['stkCallback'];

    switch ($stkCallback['ResultCode']) {
        // The service request is processed successfully.
        case 0:
            $data = [
                'action' => 5,
                'MerchantRequestID' => $stkCallback['MerchantRequestID'],
                'CheckoutRequestID' => $stkCallback['CheckoutRequestID'],
                'ResultDesc' => $stkCallback['ResultDesc'],
            ];
            foreach ($stkCallback['CallbackMetadata']['Item'] as $item) {
                if($item['Name'] === 'Amount') $data['amount'] = $item['Value'];
                if($item['Name'] === 'MpesaReceiptNumber') $data['MpesaReceiptNumber'] = $item['Value'];
                if($item['Name'] === 'TransactionDate') $data['TransactionDate'] = $item['Value'];
                if($item['Name'] === 'PhoneNumber') $data['PhoneNumber'] = $item['Value'];
            }
            break;
        
        default:
            $data = [
                'action' => 6,
                'MerchantRequestID' => $stkCallback['MerchantRequestID'],
                'CheckoutRequestID' => $stkCallback['CheckoutRequestID'],
                'ResultDesc' => $stkCallback['ResultDesc'],
            ];
            if($stkCallback['ResultCode'] === 1032) $data['statusId'] = 5;
            elseif($stkCallback['ResultCode'] === 1) $data['statusId'] = 6;
            else $data['statusId'] = 4;
            break;
    }

endif;

// more details about
if(isset($results['TransID'])){
    $data = [
        'action' => 4,
        'BillRefNumber' => $results['BillRefNumber'],
        'TransID' => $results['TransID'],
        'TransTime' => $results['TransTime'],
        // 'MSISDN' => $results['MSISDN'], how to decode mpesa phone number
        'TransAmount' => $results['TransAmount'],
        'FirstName' => $results['FirstName'],
        'MiddleName' => $results['MiddleName'],
        'LastName' => $results['LastName']
    ];
}

if(!isset($data)){
    writeToFile(LOG_MPESA,'Out of options: '.json_encode($results));
    exit('Out of options');
}

// call payment endpoint
$url = API_HOST.'payment/v1/update-callback';
$headers = [];
// print_r($data); exit;
// response from db
$resp = json_decode(callAPI('POST',$url,$headers,$data),1);
// print_j($resp); exit;
// // response to mpesa
// $resp = [
//     'status' => 'success'
// ];
print_j($resp);
// exit;

// $return = updateconfirmation($data);

// if($return['success']){
//     header('Content-Type: application/json');
//     // according to what mpesa expects
//     $resp = ['received'=>true];
//     print_r(json_encode($resp));

// } else {
//     echo "Failed to update mpesa response into techxal db";
//     writeToFile(LOG_ERROR,'Failed to update Techxal db on Mpesa response');    
// }