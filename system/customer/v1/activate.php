<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php'; 
require __dir__.'/../../.core/.mysql.php'; 
require __dir__.'/../../.core/.procedures.php';

if(!ReqPost()) ReqBad();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

// 2. Validate
if(isset($req['phone']) && !empty($req['phone'])){
    $dbdata['phone'] = validPhone($req['phone']);
} 
if(isset($req['email']) && !empty($req['email'])){
    $dbdata['email'] = validEmail($req['email']);
}

$dbdata['code'] = validInt($req['code']);
$dbdata['action'] = 2;

try {
    $return1 = PROC(CUSTOMER($dbdata))[0][0];
    
    if(isset($return1['updated']) && $return1['updated']==1){
        $response = [
            'status' => 200,
            // 'id' => $customerId
            // 'cname' => isset($customer->cname) ? $customer->cname : null,
            // 'fname' => isset($customer->fname) ? $customer->fname : null,
            // 'lname' => isset($customer->lname) ? $customer->lname : null,
            // 'phone' => isset($customer->phone) ? $customer->phone : null,
            // 'email' => isset($customer->email) ? $customer->email : null,
            // 'groupId' => $customer->groupId,
            // 'type' => $customer->type,
            // 'groups' => implode(',',$customer->groups)
        ];

    } else {
        $response = [
            'status' => 401,
            'message' => 'Invalid activation code'
        ];        
    }

} catch (Exception $e){
    $response = [
        'status' => 401,
        'message' => $e->getMessage()
    ];
}

print_j($response);