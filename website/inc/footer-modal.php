    <footer class="py-16 bg-black">
        <section class="container flex lg:flex-row flex-col items-start pb-8 border-b border-b-grayed">
            <div class="grid grid-cols-2 gap-5 w-full lg:flex lg:items-start lg:justify-between lg:w-[60%]">
                <div class="flex flex-col text-center">
                    <h2 class="font-bold text-xl mb-4 text-purple">Product</h2>

                    <ul class="text-[#9795B5] text-base *:pb-2">
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Case studies</a></li>
                        <li><a href="#">Reviews</a></li>
                        <li><a href="#">Updates</a></li>
                    </ul>
                </div>
                <div class="flex flex-col text-center">
                    <h2 class="font-bold text-base mb-4 text-purple">Company</h2>

                    <ul class="text-[#9795B5] text-base *:pb-2">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Culture</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="flex flex-col text-center">
                    <h2 class="font-bold text-base mb-4 text-purple">Support</h2>

                    <ul class="text-[#9795B5] text-base *:pb-2">
                        <li><a href="#">Getting started</a></li>
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Server status</a></li>
                        <li><a href="#">Report a bug</a></li>
                        <li><a href="#">Chat support</a></li>
                    </ul>
                </div>
            </div>

            <div class="basis-1/2 flex flex-col justify-center items-center lg:text-center mt-8 lg:mt-0">
                <h2 class="font-bold text-left lg:text-center text-base mb-4 text-purple w-full">Follow us</h2>

                <ul class="text-[#9795B5] text-base *:pb-2 flex flex-row gap-5 lg:gap-0 lg:flex-col">
                    <li>
                        <a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24"
                            aria-label="Facebook">
                            <img src="/img/Facebook.png" alt="" class="" aria-hidden="true">
                            <span class="lg:block hidden">Facebook</span>
                        </a>
                    </li>
                    <li><a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24"
                            aria-label="Twitter">
                            <img src="/img/Facebook.png" alt="" class="" aria-hidden="true">
                            <span class="lg:block hidden">X</span>
                        </a></li>
                    <li><a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24"
                            aria-label="Instagram">
                            <img src="/img/Facebook.png" alt="" class="" aria-hidden="true">
                            <span class="lg:block hidden">Instagram</span>
                        </a></li>
                    <li><a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24"
                            aria-label="LinkedIn">
                            <img src="/img/Facebook.png" alt="" class="" aria-hidden="true">
                            <span class="lg:block hidden">LinkedIn</span>
                        </a></li>
                    <li><a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24"
                            aria-label="Youtube">
                            <img src="/img/Facebook.png" alt="" class="" aria-hidden="true">
                            <span class="lg:block hidden">Youtube</span>
                        </a></li>
                </ul>
            </div>
        </section>

        <section class="container flex lg:flex-row flex-col items-center lg:justify-between px-5 lg:px-0">
            <div class="space-y-4">
                <h2 class="font-bold text-base my-4 text-purple">Payment Methods</h2>

                <div class="flex items-center gap-5">
                    <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center bg-white never-shrink"
                        aria-label="Mpesa">
                        <img src="/public/img/mpesa.png" alt="Mpesa LOGO" />
                    </a>
                    <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center bg-white never-shrink"
                        aria-label="Mpesa">
                        <img src="/public/img/mpesa.png" alt="Mpesa LOGO" />
                    </a>
                    <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center bg-white never-shrink"
                        aria-label="Mpesa">
                        <img src="/public/img/mpesa.png" alt="Mpesa LOGO" />
                    </a>
                    <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center bg-white never-shrink"
                        aria-label="Mpesa">
                        <img src="/public/img/mpesa.png" alt="Mpesa LOGO" />
                    </a>
                </div>
            </div>

            <div class="flex items-center justify-between space-x-24 space-y-4">
                <div class="flex flex-col gap-2.5 items-center justify-center">
                    <h2 class="font-bold text-sm mt-4 text-purple">Secure systems</h2>
                    <input type="text" class="bg-white h-[28px] w-[80px]">
                </div>

                <a href="#" class="size-[55px] lg:block hidden" aria-label="Go to top">
                    <img src="/public/img/go-to-top.png" alt="Go to top Icon" />
                </a>
            </div>

        </section>
    </footer>


    <!-- Start Login modal -->
    <section class="fixed top-0 bg-black/70 z-50 h-screen w-screen grid place-items-center hidden">
        <div class="bg-white max-w-[25rem] w-full py-4 px-10 rounded-lg pb-16">
            <h6 class="text-xl text-gray-text text-center my-8">Login</h6>

            <form action="" method="post" class="space-y-6">
                <div class="border border-red rounded-md text-xs text-red p-1.5">
                    <p>Error: Email and Password not matching.</p>
                </div>

                <div
                    class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow">
                    <input type="email" aria-label="Password"
                        class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                        placeholder="Enter Email" />
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                        </svg>
                    </span>
                </div>
                <div
                    class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow">
                    <input type="password"
                        class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                        placeholder="Password" />
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

                <div class="flex items-center justify-between text-sm text-[#8F8888]">
                    <a href="#">
                        Forgot Password
                    </a>
                    <a href="#">
                        Create Account
                    </a>
                </div>
            </form>
        </div>
    </section>
    <!-- End Login modal -->



    <!-- start registration form -->
    <section class="fixed top-0 bg-black/70 z-50 h-screen w-screen grid place-items-center hidden">
        <div class="bg-white max-w-[30.9375rem] w-full px-10 rounded-lg pt-7 pb-8">
            <h6 class="text-2xl text-gray-text text-center">Registration</h6>

            <form action="" method="post">
                <div class="border border-red rounded-md text-xs text-red p-1.5 my-6">
                    <p>Error: Kindly fill all the input fields.</p>
                </div>
                <div class="flex items-center gap-10 w-full">
                    <div class="grow form-control">
                        <div class="flex items-center rounded-lg error-input shadow">
                            <input type="email" aria-label="First Names"
                                class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                                placeholder="First Names" />
                        </div>
                        <!-- Add min-height and invisible by default to maintain space -->
                        <div class="min-h-[1.6875rem]">
                            <span class="error text-xs text-red-500 hidden">Please enter your first name.</span>
                        </div>
                    </div>

                    <div class="grow form-control">
                        <div class="flex items-center rounded-lg error-input shadow">
                            <input type="email" aria-label="Last Names"
                                class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                                placeholder="Last Names" />
                        </div>
                        <div class="min-h-[1.6875rem]">
                            <span class="error text-xs text-red-500 hidden">Please enter your last name.</span>
                        </div>
                    </div>
                </div>

                <div class="form-control flex flex-col gap-y-1 mb-6">
                    <div class="flex items-center rounded-lg error-input shadow">
                        <input type="email" aria-label="P"
                            class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                            placeholder="Email Address" />
                    </div>
                    <span class="error">You have entered an invalid email address.</span>
                </div>
                <div class="form-control flex flex-col gap-y-1">
                    <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="tel" aria-label="Password"
                            class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                            placeholder="Phone Number" />
                    </div>
                    <!-- <span class="error">message</span> -->
                </div>
                <div class="form-control flex flex-col gap-y-1 my-6">
                    <div class="flex items-center rounded-lg normal-input shadow">
                        <input type="tel" aria-label="Physical address"
                            class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                            placeholder="Physical address" />
                    </div>
                    <!-- <span class="error">message</span> -->
                </div>
                <div class="form-control flex flex-col gap-y-1 mb-6">
                    <div
                        class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow">
                        <input type="password"
                            class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs"
                            placeholder="Password" />
                        <span>
                            <img src="/public/img/lock-person.png" alt="Eye Closed Icon" aria-hidden="true" />
                            <div class="sr-only">Eye Closed Icon</div>
                        </span>
                    </div>
                    <!-- <span class="error">message</span> -->
                </div>

                <button class="primary-button text-center w-full">
                    Register
                </button>

                <div class="flex items-center justify-between text-sm text-[#8F8888] mt-6">
                    <p>Already a member? <a href="#" class="text-blue">Login</a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- end registration form -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>