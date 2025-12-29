<?php

require_once __dir__.'/core/config.php';
require_once __dir__.'/core/funcs.php';
require_once __dir__.'/core/mysql.php';
require_once __dir__.'/core/procs.php';

if(ReqGet()){ ?>

    <div class="flex mb-6 border-b">
        <button data-tab="login" class="btn-tab w-1/2 tab-button btn-tab-active">Login</button>
        <button data-tab="register" class="btn-tab w-1/2 tab-button">Register</button>
    </div>

    <div class="tab-content">

        <form id="login" action="/auth.php?action=login" method="post" class="space-y-6">

            <!-- <div data-class="form-notification" class="form-alert hidden" role="alert"></div> -->

            <label>Email or Phone</label>
            <input type="text" placeholder="Email or Phone" name="phonemail" required>

            <label>Password</label>
            <input type="password" placeholder="Password" name="pass" required>

            <button type="submit" class="btn btn-submit w-full">Login</button>

        </form>

        <form id="register" action="/auth.php?action=register" method="post" class="space-y-6 hidden">

            <!-- <div data-class="form-notification" class="form-alert hidden" role="alert"></div> -->

            <label>Name</label>
            <input type="text" placeholder="Name" name="name" required>

            <label>Email</label>
            <input type="text" placeholder="Email" name="email" required>

            <label>Phone</label>
            <input type="text" placeholder="Phone" name="phone" required>

            <label>Password</label>
            <input type="password" placeholder="Password" name="pass" required>

            <button type="submit" class="btn btn-submit w-full">Register</button>

        </form>

    </div>


<?php } elseif(ReqPost()) {

    // logout
    if(isset($_GET['action']) && $_GET['action']=='logout') {
        session_destroy();
        // header('Location: /');
        // exit;

        exit(print_j([
            'status' => 200,
            'url' => '/'
        ]));        
    }    

    if(isset($_GET['action']) && $_GET['action'] == 'login'){
        $dbData = [
            'action' => 2,
            // 'pass' => passEncrype($_POST['pass'])
        ];

        if(validEmail($_POST['phonemail'])) $dbData['email'] = validEmail($_POST['phonemail']);
        elseif(validPhone($_POST['phonemail'])) $dbData['phone'] = validPhone($_POST['phonemail']);
        else {
            exit(print_j([
                'status' => 400,
                'message' => 'Invalid email or phone number'
            ]));
        };

        $customer = Proc(Customer($dbData));

        if(!isset($customer[0][0]['customerId'])){
            exit(print_j([
                'status' => 400,
                'message' => 'Incorrect credentials'
            ]));
        }

        $customer = $customer[0][0];
        
        if(!password_verify($_POST['pass'],$customer['pass'])){
            exit(print_j([
                'status' => 400,
                'message' => 'Incorrect credentials'
            ]));            
        }

        $_SESSION[SESSION_KEY] = [
            'auth'      => true,
            'customer'  => base64_encode((string)$customer['customerId']), // Ensure encoding string
            'fname'     => htmlspecialchars($customer['fname'],ENT_QUOTES,'UTF-8'),
            'phone'     => isset($customer['phone']) ? htmlspecialchars($customer['phone'], ENT_QUOTES, 'UTF-8') : null,
            'email'     => isset($customer['email']) ? filter_var($customer['email'], FILTER_SANITIZE_EMAIL) : null,
            'time'      => time(), // Store login timestamp
            'ip'        => getIp(), // For security/auditing
            'agent'     => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ];
        // save the data
        
        exit(print_j([
            'status' => 200,
            'url' => '/',
            'message' => 'Login successful'
        ]));

    }




    if(isset($_GET['action']) && $_GET['action'] == 'register'){

        // validate email

        // validate phone

        $dbData = [
            'action' => 1,
            'fname' => ValidString($_POST['name']),
            'email' => validEmail($_POST['email']),
            'phone' => validPhone($_POST['phone']),
            'pass' => passEncrype($_POST['pass']),
            'code' => intRand()
        ];

        $customer = Proc(Customer($dbData));

        if(isset($customer[0][0]['customerId'])){
            $resp = [
                'status' => 200,
                'delay' => 5
            ];
        } else {
            $resp = [
                'status' => 400,
                'message' => 'Registration failed'
            ];            
        }
        exit(print_j($resp));
    }

}