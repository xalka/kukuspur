<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">

        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[1.5rem] p-0 m-0">Wishlist</h2>

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-6 font-sans">
                        <!-- <h1 class="text-2xl font-bold text-vet-black mb-6">Welcome back, Jane!</h1> -->

                        <div class="bg-white rounded-xl px-4 pb-6 shadow-md">

                            <!-- <h3 class="text-xl font-bold mb-4 text-vet-black">Recent Orders</h3> -->

                            <table class="w-full text-sm text-left rtl:text-right">

                                <thead class="text-xs">
                                    <tr class="text-[#7D7D7D]">
                                        <th scope="col" class="py-3 pl-4 text-left"><span>Image</span></th>
                                        <th scope="col">Product</th>
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

                    </div>

                </div>
                
            </section>
            
        </div>
        
    </section>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>