<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
// require __dir__.'/../../.core/.mongodb.php';
require __dir__.'/../../.core/.procedures.php';

// POST request only
if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

$errors = [];

// Required fields
$required = ['fname','lname','email','phone','password'];

foreach ($required as $value) {
    if (!isset($req[$value]) || empty(trim($req[$value]))) {
        $errors[$value] = "$value is required";
    }
}

if(!empty($errors)){
    $response = [
        'status' => 400,
        'errors' => $errors
    ];
    print_j($response);
    exit;
}
$code = intRand();
// 4. Save into mysql
$dbdata = [
    'action' => 1,
    'typeId' => 1, // $req['typeId'],
    'fname' => $req['fname'],
    'lname' => $req['lname'],
    'phone' => validPhone($req['phone']),
    'email' => validEmail($req['email']),
    'code' => $code,
    // 'password' => passEncrype(decrypt($req['password']))
    'password' => passEncrype($req['password'])
];

try {
    $return1 = PROC(CUSTOMER($dbdata))[0][0];
    
    if(isset($return1['created']) && $return1['created']==0){
        $response = [
            'status' => 400,
            'message' => isset($return1['message']) ? $return1['message'] : ""
        ];    
        if(isset($return1['phone'])) $response['errors']['phone'] = "Phone number is taken";
        if(isset($return1['email'])) $response['errors']['email'] = "Email is taken";
        print_j($response);
        exit;
    }

    $email_template = file_get_contents(__dir__.'/../../_email/verification.html');
    $email_template = str_replace('[NAME]', $dbdata['fname'], $email_template);
    $email_template = str_replace('[CODE]', $code, $email_template);
    $email_template = str_replace('[YEAR]', date('Y'), $email_template);

    // send email
    $email = [
        'recipients' => [
            [ 'email' => $dbdata['email'], 'name' => $dbdata['fname'] ]
        ],
        'subject' => 'E-vet Account Verification',
        'content' => $email_template
    ];
    $headers = [];
    $emailsent = callAPI('POST',EMAIL_ENDPOINT,$headers,json_encode($email));
    writeToFile('/tmp/'.date('Y-m-d').'-evet-email.log',$emailsent);
    
    // send sms
    $message = sprintf(
        "Hi %s, welcome to E-vet!\n\nYour OTP is: %s.\nWe're excited to have you on board\n\n",
        ucwords($dbdata["fname"]),
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

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

print_j($response);