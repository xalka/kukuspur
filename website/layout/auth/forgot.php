<?php if(!ReqAjax()) require BASE_DIR.'inc/header.php'; ?>

    <section class="grid place-items-center">

        <div class="bg-white max-w-[25rem] w-full my-10 py-4 px-10 rounded-lg pb-16 border border-off-white">

            <h6 class="text-xl text-gray-text text-center my-8">Forgot Password</h6>

            <form action="/forgot" method="post" class="space-y-6">

                <!-- <div class="border border-red rounded-md text-xs text-red p-1.5">
                    <p>Error: Email and Password not matching.</p>
                </div> -->

                <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow input-emailphone">
                    <input type="text" name="phonemail" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Enter Email or Phone"/>
                    <span class="hidden" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                        </svg>
                    </span>
                </div>

                <button class="primary-button text-center w-full">
                    Reset password
                </button>

                <div class="flex items-center justify-end text-sm mt-6">
                    <p><a href="/login" class="text-blue">Login</a></p>
                </div>

            </form>

        </div>

    </section>

<?php if(!ReqAjax()) require BASE_DIR.'inc/footer.php'; ?>