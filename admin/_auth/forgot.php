<?php

if(ReqPost()){

    csrfToken();

    do {
        $code = intRand();
    } while (empty($code) || strlen((string)$code) !== 6);

    $dbData = [
        'action' => 3,
        'passreset' => 1,
        'code' => $code
    ];
    
    if(validEmail($_POST['email'])) $dbData['email'] = validEmail($_POST['email']);
    // elseif(validPhone($_POST['phonemail'])) $dbData['phone'] = validPhone($_POST['phonemail']);
    else {
        exit(print_j([
            'status' => 400,
            'message' => 'Invalid email or phone number'
        ]));
    };

    $return = Proc(User($dbData));

    if(!empty($return) && isset($return[0][0]['updated']) && $return[0][0]['updated'] == 1){
        $return = $return[0][0];

        $link = $_SERVER['HTTP_ORIGIN'].'/auth?action=reset&p='.base64_encode('code='.$code.'&email='.$dbData['email']);

        // Send email with link to set new passowrd
        $template = file_get_contents(__dir__.'/email.html');
        $template = str_replace('[[LOGO]]', LOGO, $template);
        $template = str_replace('[[CUSTOMER_NAME]]', $return['fname'], $template);
        $template = str_replace('[[OTP_CODE]]', $code, $template);	
        $template = str_replace('[[RESET_LINK]]',$link, $template);
    
        // send email
        $email = [
            'recipients' => [[
                'email' => $dbData['email'],
                'name' => $return['fname'],
            ]],
            'subject' => 'Kukuspur Reset Password',
            'content' => $template
        ];
        $headers = [];
        $emailsent = json_decode(sendEmail($email),1);
        // writeToFile(LOG_FILE,json_decode($template));

        // set session for verifying the account
        $_SESSION[SESSION_KEY]['email'] = $dbData['email'];

        if($emailsent['sent']){
            exit(print_j([
                'status' => 200,
                'delay' => 3000,
                'url' => '/auth?action=reset',
                'message' => 'Reset successful, please check your email'
            ]));
        }
    
    } 
    
    exit(print_j([
        'status' => 400,
        'message' => 'Failed to reset password'
    ]));

} elseif(ReqGet()){

    require __dir__.'/header.php';

?>

    <h2 class="form-title">Forot Password</h2>

    <form action="/auth?action=forgot" method="post">
        
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" required />
        </div>
        
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
        <button type="submit" class="btn btn-submit">Reset</button>
    </form>

    <p class="form-option">You have your credentials ? <a data-refresh='true' href="/auth?action=login">Login</a></p>

<?php

    require __dir__.'/footer.php';

} else ReqBad();