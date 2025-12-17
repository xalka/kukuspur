<?php if(!ReqAjax()) require BASE_DIR.'inc/header.php'; ?>

<section class="grid place-items-center">

    <div class="bg-white max-w-[25rem] w-full my-10 py-4 px-10 rounded-lg pb-16 border border-off-white">

        <h6 class="text-xl text-gray-text text-center my-8 font-bold">Sign In</h6>

        <form action="/login" method="post" class="space-y-6">

            <!-- <div class="success-box">
                <p class="">Error: Email and Password not matching.</p>
            </div> -->

            <!-- <label>Email | Phone</label> -->
            <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow input-emailphone">
                <input type="text" name="phonemail" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Enter Email or Phone" required/>
                <span class="hidden" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                    </svg>
                </span>
            </div>

            <!-- <label>Password</labe> -->
            <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow input-password">
                <input type="password" name="password" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Password" required/>
                <span class="hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                    </svg>
                </span>
            </div>

            <button class="primary-button text-center w-full">
                Login
            </button>

            <div class="flex items-center justify-between text-sm">
                <a href="/forgot" class="text-blue">
                    Forgot Password
                </a>
                <a href="/register" class="text-blue">
                    Create Account
                </a>
            </div>
        </form>

    </div>

</section>

<?php if(!ReqAjax()) require BASE_DIR.'inc/footer.php'; ?>