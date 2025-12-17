<?php if(!ReqAjax()) require BASE_DIR.'inc/header.php'; ?>

<section class="grid place-items-center">

    <div class="bg-white max-w-[25rem] w-full my-10 py-4 px-10 rounded-lg pb-16 border border-off-white">

        <h6 class="text-xl text-gray-text text-center my-8">Reset Password</h6>

        <form action="/resetpassword" method="post" class="space-y-6">

            <!-- <div class="border border-red rounded-md text-xs text-red p-1.5">
                <p>Error: Email and Password not matching.</p>
            </div> -->

            <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow input-otp">
                <input type="text" name="code" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="O T P" />
                <span aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                    </svg>
                </span>
            </div>

            <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow input-password">
                <input type="password" name="password" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Password"/>
                <span class="hidden" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                    </svg>
                </span>
            </div>

            <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow input-confirm">
                <input type="password" name="confirm" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Confirm Password" />
                <span class="hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                    </svg>
                </span>
            </div>

            <button class="primary-button text-center w-full">
                Set Password
            </button>
            
        </form>

    </div>

</section>

<?php if(!ReqAjax()) require BASE_DIR.'inc/footer.php'; ?>