<!doctype html>
<html>
    <head>  
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="/public/css/style.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        
        <div class="w-full max-w-md bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Container for both forms -->
            <div class="relative w-[200%] flex transition-transform duration-700 ease-in-out" id="form-container">
                
                <!-- Login Form -->
                <div class="w-1/2 p-8 form-1 active">

                    <img src="/images/babutalk.jpeg" class="w-full"/>

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

                    <p class="form-option">You forgot your password ? <button class="form2">Reset Password</button></p>
                </div>

                <!-- Register Form -->
                <div class="w-1/2 p-8 form-2">

                    <img src="/images/babutalk.jpeg" class="w-full"/>
                    
                    <h2 class="form-title">Reset Password</h2>

                    <form action="/auth.php?action=reset" method="post">
                        
                        <div class="mb-4">
                            <label>Email</label>
                            <input type="text" name="email" required />
                        </div>
                        
                        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
                        <button type="submit" class="btn btn-submit">Reset</button>
                    </form>

                    <p class="form-option">You have your credentials ? <button class="form1">Login</button></p>
                </div>
            
            </div>
        </div>   

        <script src="/public/js/jquery-3.7.1.min.js"></script>  
        <script src="/public/js/script.js"></script> 
    </body>
</html>