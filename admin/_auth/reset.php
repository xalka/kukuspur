<?php

if(ReqPost()){

    csrfToken();

    if($_POST['password'] != $_POST['password2']){
        exit(print_j([
            'status' => 400,
            'message' => 'Password does not match'
        ]));
    }

    $dbData = [
        'action' => 4,
        'code' => validInt($_POST['code']),
        'pass' => passEncrype($_POST['password']),
    ];

    if(isset($_SESSION[SESSION_KEY]['email'])){
        $dbData['email'] = $_SESSION[SESSION_KEY]['email'];
    } else {
        $dbData['email'] = validEmail($_POST['email']);
    }

    $return = Proc(User($dbData));

    if(!empty($return) && isset($return[0][0]['updated']) && $return[0][0]['updated'] == 1){
        $return = $return[0][0];

        exit(print_j([
            'status' => 200,
            'delay' => 1000,
            'url' => '/auth',
            'message' => 'Reset password successfully'
        ]));
    
    }
    
    exit(print_j([
        'status' => 400,
        'message' => 'Failed to reset password'
    ]));

} elseif(ReqGet()){

    require __dir__.'/header.php';

    if(!isset($_SESSION[SESSION_KEY]['email'])){

        $params = explode('&', base64_decode($_GET['p']));
        foreach ($params as $param){
            $param = explode('=', $param);
            $data[$param[0]] = $param[1];
        }
    }  

?>

    <h2 class="form-title">Reset Password</h2>

    <form action="/auth?action=reset" method="post">
    <?php if(isset($data['email'])): ?>
        <input type="hidden" name="email" value="<?=$data['email']?>">
        <input type="hidden" name="code" value="<?=$data['code']?>">
    <?php else: ?>

        <div class="mb-4">
            <label>OTP</label>
            <input type="text" name="code" required />
        </div>
    <?php endif; ?>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        
        <div class="mb-4">
            <label>Confirm Password</label>
            <input type="password" name="password2" required />
        </div>        
        
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
        <button type="submit" class="btn btn-submit">Reset</button>
    </form>

    <p class="form-option">You have your credentials ? <a data-refresh='true' href="/auth?action=login">Login</a></p>

<?php

    require __dir__.'/footer.php';

} else ReqBad();