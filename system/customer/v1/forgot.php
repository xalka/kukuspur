<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

// 2. Validate
$code = intRand();
$dbdata = [
    'action' => 4,
    'verified' => 1,
    'active' => 1,
    'code' => $code
];

if(isset($req['phone']) && !empty($req['phone'])){
    $dbdata['phone'] = validPhone($req['phone']);
} else {
    $dbdata['email'] = validEmail($req['email']);
}

try {
    $customer = PROC(CUSTOMER($dbdata))[0][0];

    if($customer['updated']==1){

        $email_template = file_get_contents(__dir__.'/../../_email/forgotpassword.html');
        $email_template = str_replace('[NAME]', $customer['fname'], $email_template);
        $email_template = str_replace('[CODE]', $code, $email_template);
        $email_template = str_replace('[YEAR]', date('Y'), $email_template);

        // send email
        $email = [
            'recipients' => [
                [ 'email' => $customer['email'], 'name' => $customer['fname'] ]
            ],
            'subject' => 'E-vet Forgot Password',
            'content' => $email_template
        ];
        writeToFile('/tmp/'.date('Y-m-d').'-evet-email.log',$email);
        $headers = [];
        $emailsent = callAPI('POST',EMAIL_ENDPOINT,$headers,json_encode($email));
        writeToFile('/tmp/'.date('Y-m-d').'-evet-email.log',$emailsent);
        
        // send sms
        $message = sprintf(
            "Hi %s, welcome back to E-vet!\n\nYour OTP is: %s.\n\n",
            ucwords($customer["fname"]),
            $code
        );

        $headers = [
            'Content-Type: application/json',
            'cache-control: no-cache',
            'Username: '.SMS_USERNAME,
            'userId: '. 1,
            'businessId: '.SMS_BUSINESSID,
            'Authtoken: '.SMS_TOKEN
        ];
        $req = [
            'username' => SMS_USERNAME,
            'shortcode' => SMS_SHORTCODE,
            'userId' => 1,
            'businessId' => SMS_BUSINESSID,
            'contacts' => $dbdata['phone'],
            'message' => $message
        ];
        $smssent =  json_decode(callAPI("POST", SMSENDPOINT, $headers, $req),1);
        writeToFile('/tmp/'.date('Y-m-d').'-evet-sms.log',$smssent);        

        $response = [
            'status' => 201
        ];
        
    } else {
        $response = [
            'status' => 400,
            'message' => 'The customer does not exist'
        ];        
    }

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);