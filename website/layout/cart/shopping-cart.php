<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <main class="pt-4 text-gray">
        <div class="container mb-64">
            <ul class="bread-crumbs flex items-center text-sm pb-[0.63rem] border-b border-b-standard-gray">
                <li><a href="/" class="active">Home</a></li>
                <li><a href="#" class="active">Category</a></li>
                <!-- <li><a href="#">Sub-category</a></li> -->
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
                                    <th scope="col" class="py-3 pl-4 text-left"><span>Product</span></th>
                                    <th scope="col" class="sr-only">Product</th>
                                    <th scope="col" class="py-3 text-center">Unit Price</th>
                                    <th scope="col" class="px-6 py-3 text-center">Quantity</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                            <?php foreach ($data['items'] as $product) { ?>
                                <tr class="border-b border-gray-border hover:bg-gray-100">
                                    <td class="p-4">
                                        <img src="/public/img/uploads/<?=$product['img']?>" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                                    </td>
                                    <td class="px-6 py-4"><p><?=$product['product']?></p></td>
                                    <td class="px-6 py-4">Kes <?=$product['price']?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center border-2 border-off-white text-standard-gray rounded-md w-fit py-1 px-2 bg-white">
                                            <button type="button" data-decrease="<?=$product['productId']?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M19 12.998H5v-2h14z" />
                                                </svg>
                                            </button>
                                            <span class="mx-2.5">
                                                <input name="qty" type="text" value="<?=$product['qty']?>" placeholder="0" class="w-6 text-center" data-productId="<?=$product['productId']?>"/>
                                            </span>
                                            <button type="button" data-increase="<?=$product['productId']?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" class="text-red" data-omit="<?=$product['productId']?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M5 21V6H4V4h5V3h6v1h5v2h-1v15zm2-2h10V6H7zm2-2h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end cart table -->

                    <div class="flex items-center justify-end mr-6 mt-4">
                        <a class="primary-button" href="/checkout">
                            Proceed to checkout
                        </a>
                    </div>
                </div>
                <aside class="never-shrink lg:max-w-[19.3125rem] w-full cart-summary">
                    <div class="w-full bg-white py-4 *:px-5 rounded-md border border-off-white text-standard-gray pb-16">
                        <h3 class="font-medium text-xl text-gray">Cart Summary</h3>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5">
                            <span class="text-[0.9375rem]">Subtotal</span>
                            <strong class="text-blue">KES <span data-class="subtotal"><?=$data['totals']['subtotal']?></span></strong>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5">
                            <span class="text-[0.9375rem] uppercase text-xs">Discount</span>
                            <!-- <strong class="">KES <?=$data['totals']['totalDiscount']?></strong> -->
                            <strong>KES <span data-class="discount"><?=$data['totals']['discount']?></span></strong>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5">
                            <span class="text-[0.9375rem] uppercase text-xs">Tax</span>
                            <strong>KES <span data-class="tax"><?=$data['totals']['tax']?></span></strong>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5">
                            <span class="text-[0.9375rem]">Shipping</span>
                            <div>
                                <strong>KES <span data-class="shipping"><?=$data['totals']['shipping']?></span></strong>
                                <!-- <p class="text-[#1E285F] mt-4 text-xs">Change Address</p> -->
                            </div>
                        </div>
                        <hr class="bordered" />
                        <div class="grid grid-cols-2 gap-2.5 mt-1.5">
                            <span class="text-[0.9375rem] text-xs">Total Amount</span>
                            <strong class="text-blue text-xl">KES <span data-class="total"><?=$data['totals']['total']?></span></strong>
                        </div>
                        <hr class="bordered" />
                        <div class="mx-5 pt-2">
                            <a href="/checkout">
                                <button class="secondary-button text-black w-full">
                                    Checkout
                                </button>
                            </a>
                        </div>
                    </div>
                </aside>
            </section>
            <!-- end main content section -->
        </div>
    </main>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>