<?php

if(ReqPost()){

    csrfToken();

    $dbData = [
        'action' => 1,
        // 'pass' => $_POST['pass']
    ];

    if(validEmail($_POST['phonemail'])) $dbData['email'] = validEmail($_POST['phonemail']);
    elseif(validPhone($_POST['phonemail'])) $dbData['phone'] = validPhone($_POST['phonemail']);
    else {
        exit(print_j([
            'status' => 400,
            'message' => 'Invalid email or phone number'
        ]));
    };


    $return = Proc(User($dbData));

    if(!empty($return) && isset($return[0][0]['userId'])){
        $return = $return[0][0];
        
        if(password_verify($_POST['pass'],$return['pass'])){
            $_SESSION[SESSION_KEY] = [
                'auth'      => true,
                'userId'  => base64_encode((string) $return['userId']), // Ensure encoding string
                'fname'     => htmlspecialchars($return['fname'], ENT_QUOTES, 'UTF-8'),
                // 'roleId'  => (int) $return['roleId'], // Explicit cast
                'phone'     => isset($return['phone']) ? htmlspecialchars($return['phone'], ENT_QUOTES, 'UTF-8') : null,
                'email'     => isset($return['email']) ? filter_var($return['email'], FILTER_SANITIZE_EMAIL) : null,
                'time'      => time(), // Store login timestamp
                'ip'        => getIp(), // For security/auditing
                'agent'     => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
            ];
            // save the data
            
            $response = [
                'status' => 200,
                'url' => '/',
                'message' => 'Login successful'
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'The credential dont match'
            ];
        }        
    } else {
        $response = [
            'status' => 400,
            'message' => 'The credential dont match'
        ];        
    }
    exit(print_j($response));


} elseif(ReqGet()){ 
    
    require __dir__.'/header.php';
    
?>
    
    <h2 class="form-title">Login</h2>

    <form action="/auth.php?action=login" method="post">

        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="phonemail" required />
        </div>
        <div class="mb-6">
            <label>Password</label>
            <input type="password" name="pass" required />
        </div>
        <button type="submit" class="btn btn-submit">Login</button>
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
    </form>

    <p class="form-option">You forgot your password ? <a data-refresh='true' href="/auth?action=forgot">Reset Password</a></p>

<?php 

    require __dir__.'/footer.php';

} else ReqBad();

?>