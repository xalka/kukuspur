        </div>
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
                            <a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24" aria-label="Facebook">
                                <img src="/public/img/Facebook.png" alt="" class="" aria-hidden="true">
                                <span class="lg:block hidden">Facebook</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24" aria-label="Twitter">
                                <img src="/public/img/Facebook.png" alt="" class="" aria-hidden="true">
                                    <span class="lg:block hidden">X</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24" aria-label="Instagram">
                                <img src="/public/img/Facebook.png" alt="" class="" aria-hidden="true">
                                    <span class="lg:block hidden">Instagram</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24" aria-label="LinkedIn">
                                <img src="/public/img/Facebook.png" alt="" class="" aria-hidden="true">
                                    <span class="lg:block hidden">LinkedIn</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-start gap-2.5" width="21" height="24" aria-label="Youtube">
                                <img src="/public/img/Facebook.png" alt="" class="" aria-hidden="true">
                                    <span class="lg:block hidden">Youtube</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="container flex lg:flex-row flex-col items-center lg:justify-between px-5 lg:px-0">
                <div class="space-y-4">
                    <h2 class="font-bold text-base my-4 text-purple">Payment Methods</h2>

                    <div class="flex items-center gap-5">
                        <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center" aria-label="Mpesa">
                            <img src="/public/img/assets/mpesa.png" alt="Mpesa LOGO"/>
                        </a>
                        <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center" aria-label="VisaCard">
                            <img src="/public/img/assets/visa.png" alt="VisaCard"/>
                        </a>
                        <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center" aria-label="MasterCard">
                            <img src="/public/img/assets/mastercard.png" alt="MasterCard"/>
                        </a>
                        <a href="#" class="w-[5.625rem] h-[3.125rem] grid place-items-center" aria-label="Paypal">
                            <img src="/public/img/assets/paypal.png" alt="Paypal"/>
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-between space-x-24 space-y-4">
                    <!-- <div class="flex flex-col gap-2.5 items-center justify-center">
                        <h2 class="font-bold text-sm mt-4 text-purple">Secure systems</h2>
                            <input type="text" class="bg-white h-[28px] w-[80px]">
                    </div> -->

                    <a href="#" class="size-[55px] lg:block hidden" aria-label="Go to top">
                        <img src="/public/img/go-to-top.png" alt="Go to top Icon" />
                    </a>
                </div>

            </section>

            <!-- Start Modal Window -->
            <section id="modal" class="fixed inset-0 z-50 grid place-items-center bg-black/80 hidden">
                <!-- <div class="modal-size xs:w-full sm:w-full md:w-4/5 lg:w-2/3 xl:w-1/2 rounded-lg bg-white text-dark-gray max-h-[90vh] overflow-y-auto"> -->
                <div class="modal-size xs:w-11/12 sm:w-11/12 md:w-4/5 lg:w-1/3 rounded-lg bg-white text-dark-gray max-h-[80vh] overflow-y-auto">
                    <div class="flex w-full items-center text-[20px] border-b border-b-gray-border my-2 py-2 px-6">
                        <div class="font-semibold capitalize modal-title text-[#1D9D22]">
                        </div>
                        <button type="button" class="ml-auto" data-close="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 34 34" fill="none">
                                <path d="M17.0002 29.9524C24.1536 29.9524 29.9526 24.1534 29.9526 17C29.9526 9.84659 24.1536 4.04761 17.0002 4.04761C9.84683 4.04761 4.04785 9.84659 4.04785 17C4.04785 24.1534 9.84683 29.9524 17.0002 29.9524Z" stroke="#f00" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12.1436 12.1428L21.8578 21.8571M21.8578 12.1428L12.1436 21.8571" stroke="#f00" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="modal-content my-2 py-2 px-6">
                        <div class="flex flex-col items-center justify-center mt-4">
                            <svg class="animate-spin h-8 w-8 text-blue" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                            <p class="mt-6 text-gray">Please wait...</p>
                        </div>
                    </div>
                </div>
            </section>        

        </footer>
        <script src="/public/js/jquery-3.7.1.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_PLACE_KEY?>"></script>
        <script src="/public/js/script.js?v=<?=time()?>"></script>
    </body>
</html>