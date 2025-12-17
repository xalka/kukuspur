<?php 

$headers = getallheaders();

require __dir__.'/core/config.php';
require __dir__.'/core/funcs.php';

Authentication();

$sess = $_SESSION[SESSION_KEY];

$headers = [
    'customerId: '.base64_decode($sess['id']),
    'typeId: '.$sess['typeId']
];

    require __dir__.'/inc/header.php'; 

?>


    <main class="pt-[10.1748rem] text-gray">
        <div class="container mb-64">
            <ul class="bread-crumbs flex items-center text-sm pb-[0.63rem] border-b border-b-standard-gray">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#" class="active">Category</a></li>
                <li><a href="#">Sub-category</a></li>
            </ul>

            <!-- start main content section -->
            <section class="flex flex-col lg:flex-row mt-5 gap-5">
                <div class="grow flex flex-col gap-y-5 border border-off-white bg-gray-50 rounded-lg pb-8">
                    <!-- start cart table -->
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right">
                            <caption class="p-5 text-lg font-semibold text-left rtl:text-right">
                                My cart
                            </caption>

                            <thead class="text-xs">
                                <tr class="text-[#7D7D7D]">
                                    <th scope="col" class="py-3 pl-4 text-left">
                                        <span>Product</span>
                                    </th>
                                    <th scope="col" class="sr-only">
                                        Product
                                    </th>

                                    <th scope="col" class="py-3 text-center">
                                        Unit Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                                <tr class="border-b border-gray-border hover:bg-gray-100">
                                    <td class="p-4">
                                        <img src="/img/inek-yatagi-KEWPlus-katman-3.svg"
                                            class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                                    </td>
                                    <td class="px-6 py-4">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">
                                        $2499
                                    </td>
                                    <td class="px-6 py-4">
                                        <div
                                            class="flex items-center border-2 border-off-white text-standard-gray rounded-md w-fit py-1 px-2 bg-white">
                                            <button type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M19 12.998H5v-2h14z" />
                                                </svg>
                                            </button>
                                            <span class="mx-2.5">5</span>
                                            <button type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" class="text-red">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M5 21V6H4V4h5V3h6v1h5v2h-1v15zm2-2h10V6H7zm2-2h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-border hover:bg-gray-50">
                                    <td class="p-4">
                                        <img src="/img/inek-yatagi-KEWPlus-katman-3.svg"
                                            class="w-16 md:w-32 max-w-full max-h-full" alt="Apple iMac">
                                    </td>
                                    <td class="px-6 py-4">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    </td>

                                    <td class="px-6 py-4">
                                        $2499
                                    </td>
                                    <td class="px-6 py-4">
                                        <div
                                            class="flex items-center border-2 border-off-white text-standard-gray rounded-md w-fit py-1 px-2 bg-white">
                                            <button type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M19 12.998H5v-2h14z" />
                                                </svg>
                                            </button>
                                            <span class="mx-2.5">5</span>
                                            <button type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" class="text-red">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M5 21V6H4V4h5V3h6v1h5v2h-1v15zm2-2h10V6H7zm2-2h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end cart table -->

                    <div class="flex items-center justify-end mr-6 mt-4">
                        <button class="primary-button">
                            Update cart
                        </button>
                    </div>
                </div>
                <aside class="never-shrink lg:max-w-[19.3125rem] w-full">
                    <div
                        class="w-full bg-white py-4 *:px-5 rounded-md border border-off-white text-standard-gray pb-16">
                        <h3 class="font-medium text-xl text-gray">Cart totals</h3>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5">
                            <span class="text-[0.9375rem]">subtotal</span>
                            <strong class="text-blue">KES 462.00</strong>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5">
                            <span class="text-[0.9375rem]">Shipping</span>
                            <div>
                                <strong>KES 325.00</strong>
                                <p class="text-[#1E285F] mt-4 text-xs">Change Address</p>
                            </div>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5">
                            <span class="text-[0.9375rem] uppercase text-xs">VAT</span>
                            <strong class="">KES 325.00</strong>
                        </div>
                        <div class="grid grid-cols-2 gap-2.5 mt-1.5">
                            <span class="text-[0.9375rem] text-xs">Total Amount</span>
                            <strong class="text-blue text-xl">KES 462.00</strong>
                        </div>
                        <hr class="bordered" />
                        <div class="mx-5 pt-2">
                            <button class="secondary-button text-black w-full">
                                Checkout
                            </button>
                        </div>
                    </div>
                </aside>
            </section>
            <!-- end main content section -->
        </div>
    </main>


<?php require __dir__.'/inc/footer.php'; ?>