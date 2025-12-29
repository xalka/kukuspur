<?php

require_once __dir__.'/core/config.php';
require_once __dir__.'/core/funcs.php';
require_once __dir__.'/core/mysql.php';
require_once __dir__.'/core/procs.php';

if(ReqGet()){ 

    if(isset($_GET['action']) && $_GET['action']=='status'){
        $dbData = [
            'action' => 6,
            'paymentId' => validInt($_GET['paymentId'])
        ];
        $status = Proc(Payment($dbData));   
        if(isset($status[0][0]['statusId'])){
            print_j([
                'status' => $status[0][0]['status']
            ]);
        };
        exit;
    }  
    
    
?>


<div class="bg-gray-50 p-4">

    <form class="max-w-4xl mx-auto" method="post" action="/subscribe?action=payment">

        <h2 class="text-lg font-bold text-center text-gray-800 mb-8">Choose Your Subscription plan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <?php

            $dbData = [
                'action' => 4,
            ];
            $packages = Proc(Customer($dbData))[0];            

            foreach ($packages as $plan) {

        ?>
        
            <!-- Daily Plan -->
            <label class="relative cursor-pointer bg-white p-4 rounded-2xl shadow-md hover:shadow-lg border-2 border-transparent hover:border-green-500 transition duration-300 peer-checked:border-green-600">
                <input type="radio" name="planId" value="<?=$plan['planId']?>" class="peer sr-only" required <?php if($plan['preferred']) { ?>checked <?php }?> >
                <div class="flex flex-col space-y-2">
                    <span class="text-lg font-semibold text-gray-900 capitalize"><?=$plan['plan']?></span>
                    <span class="text-sm text-gray-600">Ksh <?=$plan['price']?> per <?=$plan['unit']?></span>
                <?php if($plan['preferred']) { ?>
                    <span class="text-xs text-green-600 font-medium">Best Value</span>
                <?php } ?>
                </div>
                <div class="absolute top-4 right-4 hidden peer-checked:block text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </label>

        <?php } ?>

        </div>

        <div class="mt-8">
            <label>Mpesa</label>
            <input type="text" placeholder="Phone Number" name="phone" required>
            <input type="hidden" name="paymentId"/>
        </div>

        <div class="mt-8 text-center">
            <button type="submit" class="btn btn-submit">
                Continue to Payment
            </button>
        </div> 

    </form>

</div>



<?php } elseif(ReqPost()) {

    $_GET['action'] ?? null;

    switch ($_GET['action']) {
        case 'newsletter':
            $dbData = [
                'action' => 3,
                'email' => validEmail($_POST['phonemail']),
                'phone' => validPhone($_POST['phonemail']),
            ];
            $newletter = Proc(Customer($dbData));
            if(isset($newletter[0][0]['id'])){
                $resp = [
                    'status' => 200,
                    'delay' => 5
                ];
            } else {
                $resp = [
                    'status' => 400,
                    'message' => 'Subscription failed'
                ];
            }
            exit(print_j($resp));
            break;

        case 'payment':
            $code = intRand();
            $dbData = [
                'action' => 1,
                'modeId' => 1,
                'statusId' => 1,
                'planId' => validInt($_POST['planId']),
                'phone' => validPhone($_POST['phone']),
                'pass' => passEncrype($code)
            ];

            // if loggedin, include customer id
            if(Authenticated()) $dbData['customerId'] = validInt(base64_decode($_SESSION[SESSION_KEY]['customerId']));
            
            // save into db
            $payment = Proc(Payment($dbData));

            if(!isset($payment[0][0]['paymentId'])){
                exit(print_j(['status' => 400,'message' => 'Payment failed']));
            }

            $payment = $payment[0][0];
            
            // push to mpesa
            // move to cronjob, and read from file
            $url = MPESA_API.'oauth/v1/generate?grant_type=client_credentials';
            $headers = ['Authorization: Basic '.base64_encode(MPESA_KEY.':'.MPESA_SECRET)];
            $token = json_decode(callAPI('GET',$url,$headers),1);

            // save the stk push data
            $url = MPESA_API.'mpesa/stkpush/v1/processrequest';
            $headers = ['Content-Type:application/json','Authorization:Bearer '.$token['access_token']];
            $request = [
                'BusinessShortCode'     => MPESA_SHORTCODE,
                'Password'              => base64_encode(MPESA_SHORTCODE.MPESA_PASSKEY.TIMESTAMP),
                'Timestamp'             => TIMESTAMP,
                'TransactionType'       => 'CustomerPayBillOnline',
                'Amount'                => $payment['amount'],
                'PartyA'                => $dbData['phone'],
                'PartyB'                => MPESA_SHORTCODE,
                'PhoneNumber'           => $dbData['phone'],
                'CallBackURL'           => MPESA_CALLBACK.'subscribe?action=043b13af87845ad3958501f834f88f4539bcf278cc69f0c87f8dc4557431690c',
                'AccountReference'      => ucwords($payment['plan']).' plan ',
                'ThirdPartyTransID'     => $payment['paymentId'],
                'TransactionDesc'       => ucwords($payment['plan']).' plan'
            ];
            $response = json_decode(callAPI('POST',$url,$headers,$request),1);

            if(isset($response['ResponseCode']) && $response['ResponseCode'] == '0'){
                $dbData = [
                    'action' => 2,
                    'statusId' => 2,
                    'paymentId' => $payment['paymentId'],
                    'MerchantRequestID' => validString($response['MerchantRequestID']),
                    'CheckoutRequestID' => validString($response['CheckoutRequestID']),
                    'description' => validString($response['ResponseDescription'])
                ];
                $resp = Proc(Payment($dbData));
                if(isset($resp[0][0]['updated']) && $resp[0][0]['updated']==1){
                    $resp = [
                        'status' => 200,
                        'confirm' => 1,
                        'paymentId' => $payment['paymentId']
                    ];
                } else {
                    $resp = [
                        'status' => 400,
                        'message' => 'Payment failed'
                    ];
                };
            } else {
                $resp = [
                    'status' => 400,
                    'message' => 'Payment failed'
                ];
            }
            exit(print_j($resp));
            
            break;

        // whitelisted APIs online
        case '043b13af87845ad3958501f834f88f4539bcf278cc69f0c87f8dc4557431690c':
            print_r($_POST);
            // if payment is successful, send OTP to new customer
            break;
        
        default:
            ReqBad();
            break;
    }

}