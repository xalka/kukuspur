<?php

// validate

if(is_numeric($_POST['phonemail'])){
    $request['phone'] = $_POST['phonemail'];
} else {
    $request['email'] = $_POST['phonemail'];
}
// $request['password'] = encrypt($_POST['password']);
$request['password'] = $_POST['password'];

$customer = json_decode(callAPI('POST','customer/v1/login',$request, $headers),1); 

if(isset($customer['id'])){
    // check if there is a cart on the session
    if(isset($_SESSION['cart'])){ 
        $dbdata = [];
        foreach($_SESSION['cart'] as $item){
            $dbdata[] = [
                'productId' => $item['productId'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'tax' => $item['tax'],
                'customerId' => $customer['id']
            ];  
        }

        $headers = [
            'customerId: '.$customer['id'],
            'typeId: '.$customer['typeId']
        ];
        
        $cart = json_decode(callAPI('POST', 'cart/v1/create', $dbdata, $headers),1);
    }

    if(isset($_POST['remember'])){
        setcookie("username", $customer['fname'], time() + (86400 * 30), "/");
    } else {
        setcookie("username", "", time() - 3600, "/");
    }

    // session
    $_SESSION[SESSION_KEY] = [
        'auth' => 1,
        'id' => base64_encode($customer['id']),
        'phone' => base64_encode($customer['phone']),
        'email' => base64_encode($customer['email']),
        'fname' => base64_encode($customer['fname']),
        'lname' => base64_encode($customer['lname']),
        //'type' => base64_encode($customer['type']),
        //'longitude' => base64_encode($customer['longitude']),
        //'latitude' => base64_encode($customer['latitude']),
        'typeId' => $customer['typeId']
    ];

    $request = [
        'customerId' => $customer['id']
    ];
    $items = json_decode(callAPI('GET', 'cart/v1/view', $request, $headers),1);
    if($items){
        $_SESSION['cart'] = $items; 
    }
    
    $response = [
        'status' => 200,
        'url' => $_SESSION['redirect'] ?? '/',
        'delay' => 0
    ];

} else {
    $response = [
        'status' => 400,
        'message' => $customer['message']
    ];
}

print_j($response);

// send a verification code


// redirect to verification page