<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <main class="pt-4 text-gray">
        <div class="container mb-64">
            <ul class="bread-crumbs flex items-center text-sm pb-[0.63rem] border-b border-b-standard-gray">
                <li><a href="/" class="active">Home</a></li>
                <li><a href="/checkout">Checkout</a></li>
            </ul>

            <!-- start main content section -->
            <section class="flex mt-5 gap-5">

                <div class="grow flex flex-col border border-off-white bg-gray-50 rounded-lg pb-8">
                    
                    <!-- start tabs -->
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="billing-tab"
                                    data-tabs-target="#billing" type="button" role="tab" aria-controls="billing"
                                    aria-selected="false">Billing details</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                    id="shipping-tab" data-tabs-target="#shipping" type="button" role="tab"
                                    aria-controls="shipping" aria-selected="false">Shipping address</button>
                            </li>
                        </ul>
                    </div>

                    <div id="default-tab-content">

                        <div class="px-4 pt-4 rounded-lg bg-gray-50" id="billing" role="tabpanel"
                            aria-labelledby="billing-tab">
                            <form action="" method="post" class="grid grid-cols-2 gap-5 mb-10">
                                <div class="error-box col-span-full">
                                    <p>Error: Email and Password not matching.</p>
                                </div>

                                <div class="form-control col-span-full">
                                    <label for="phone-number" class="mb-1 text-sm font-medium error block">
                                        Phone number <span class="text-red">*</span>
                                    </label>
                                    <input type="text" id="phone-number"
                                        class="error-input-field rounded text-sm block w-full p-2.5"
                                        placeholder="Phone number">
                                    <p class="mt-1 text-sm error">
                                        <span class="font-medium">Oh, snapp!</span> Some error message.
                                    </p>
                                </div>

                                <div class="form-control text-vet-black font-extralight text-sm">
                                    <label for="full-names" class="mb-1 block">
                                        First Names <span class="text-red">*</span>
                                    </label>
                                    <input type="text" id="full-names" class="rounded block w-full p-2.5 bordered-input"
                                        placeholder="First Names">
                                    <!-- <p class="mt-1 text-sm error">
                                        <span class="font-medium">Oh, snapp!</span> Some error message.
                                    </p> -->
                                </div>
                                <div class="form-control text-vet-black font-extralight text-sm">
                                    <label for="last-ames" class="mb-1 block">
                                        Last Names <span class="text-red">*</span>
                                    </label>
                                    <input type="text" id="last-ames" class="rounded block w-full p-2.5 bordered-input"
                                        placeholder="Last Names">
                                    <!-- <p class="mt-1 text-sm error">
                                        <span class="font-medium">Oh, snapp!</span> Some error message.
                                    </p> -->
                                </div>

                                <div class="form-control text-vet-black font-extralight text-sm col-span-full">
                                    <label for="email-address" class="mb-1 text-sm block">
                                        Email address <span class="text-red">*</span>
                                    </label>
                                    <input type="text" id="email-address"
                                        class="rounded block w-full p-2.5 bordered-input" placeholder="Email address">
                                    <!-- <p class="mt-1 text-sm error">
                                        <span class="font-medium">Oh, snapp!</span> Some error message.
                                    </p> -->
                                </div>

                                <div class="form-control text-vet-black font-extralight text-sm col-span-full">
                                    <label for="street-address" class="mb-1 text-sm block">
                                        Street address <span class="text-red">*</span>
                                    </label>
                                    <input type="text" id="street-address"
                                        class="rounded block w-full p-2.5 bordered-input" placeholder="Street address">
                                    <!-- <p class="mt-1 text-sm error">
                                        <span class="font-medium">Oh, snapp!</span> Some error message.
                                    </p> -->
                                </div>

                                <div class="form-control text-vet-black font-extralight text-sm col-span-full">
                                    <label for="country" class="mb-1 text-sm block">
                                        Country<span class="text-red">*</span>
                                    </label>
                                    <input type="text" id="country" class="rounded block w-full p-2.5 bordered-input"
                                        placeholder="Country">
                                    <!-- <p class="mt-1 text-sm error">
                                        <span class="font-medium">Oh, snapp!</span> Some error message.
                                    </p> -->
                                </div>

                                <div class="form-control text-vet-black font-extralight text-sm col-span-full">
                                    <label for="town-city" class="mb-1 text-sm block">
                                        Town / City<span class="text-red">*</span>
                                    </label>
                                    <input type="text" id="town-city" class="rounded block w-full p-2.5 bordered-input"
                                        placeholder="Town / City">
                                    <!-- <p class="mt-1 text-sm error">
                                        <span class="font-medium">Oh, snapp!</span> Some error message.
                                    </p> -->
                                </div>
                            </form>
                        </div>

                        <div class="hidden p-4 rounded-lg bg-gray-50" id="shipping" role="tabpanel"
                            aria-labelledby="shipping-tab">
                            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the
                                <strong class="font-medium text-gray-800 dark:text-white">shipping tab's associated
                                    content</strong>. Clicking another tab will toggle the visibility of this one for
                                the next. The tab JavaScript swaps classes to control the content visibility and
                                styling.
                            </p>
                        </div>

                    </div>
                    <!-- end tabs -->
                </div>

                <aside class="never-shrink max-w-[27rem] w-full">
                    <div class="w-full bg-white py-4 *:px-5 rounded-md border border-off-white text-standard-gray pb-8">
                        <h3 class="font-medium text-xl text-gray">My order</h3>
                        <hr class="bordered" />
                        <h3 class="text-base font-medium">Product</h3>
                        <hr class="bordered" />

                        <div class="grid grid-cols-3 gap-2.5">
                            <p class="line-clamp-2 text-sm col-span-2">
                                Lorem Ipsum is simply dummy printing and typesetting
                                industry.
                            </p>
                            <span class="text-center">3</span>
                        </div>

                        <hr class="bordered" />
                        <div class="grid grid-cols-3 gap-2.5 mt-8">
                            <span class="text-[0.9375rem] col-span-2">subtotal</span>
                            <strong class="text-blue">KES 462.00</strong>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-3 gap-2.5">
                            <span class="text-[0.9375rem] col-span-2">Shipping</span>
                            <strong>KES 325.00</strong>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-3 gap-2.5">
                            <span class="text-[0.9375rem] uppercase text-xs col-span-2">VAT</span>
                            <strong>KES 325.00</strong>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-3 gap-2.5 mt-8">
                            <span class="text-[0.9375rem] text-xs col-span-2">Total Amount</span>
                            <strong class="text-blue text-xl">KES 462.00</strong>
                        </div>
                        <hr class="bordered" />

                        <div class="flex flex-col">
                            <h4 class="text-gray text-xl">Payment Options</h4>


                            <div class="flex items-center gap-5 mt-4 mb-8">
                                <div class="flex items-center rounded">
                                    <input checked id="bordered-radio-1" type="radio" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="bordered-radio-1" class="w-full ms-2">
                                        <img src="/img/mpesa.svg" alt="Mpesa Image" />
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="bordered-radio-2" type="radio" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="bordered-radio-2" class="w-full">
                                        <img src="img/visa.svg" alt="Visa Image" />
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="bordered-radio-2" type="radio" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="bordered-radio-2" class="w-full">
                                        <img src="img/mastercard.svg" alt="Mastercard Image" />
                                    </label>
                                </div>
                            </div>

                            <p class="text-[0.7rem] leading-tight">Your personal data will be used to process your
                                order, support your experience <br> throughout this website, and for other purposes
                                described in our <a href="#" class="underline text-blue">privacy policy.</a>
                            </p>
                        </div>

                        <div class="mt-4 flex justify-center">
                            <button class="primary-button max-w-[15.9375rem] w-full">
                                Place Order
                            </button>
                        </div>
                    </div>
                </aside>

            </section>

        </div>
    </main>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>