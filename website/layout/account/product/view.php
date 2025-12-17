<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">

        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">
                
                <div class="flex flex-row justify-between border-b border-b-gray-border py-2">

                    <h2 class="text-xl md:text-[1.5rem] p-0 m-0">Products</h2>

                    <a class="text-quick-gray text-xs font-semibold border py-1 px-4 rounded-lg bg-blue text-white cursor-pointer hidden" data-modal-href="/account?view=product&action=create" data-size="lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>

                    <a class="text-quick-gray text-xs font-semibold border py-1 px-4 rounded-lg bg-blue text-white cursor-pointer" href="/account?view=product&action=create" data-size="lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>

                </div>                

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-6 font-sans">
                        <!-- <h1 class="text-2xl font-bold text-vet-black mb-6">Welcome back, Jane!</h1> -->

                        <div class="bg-white rounded-xl px-4 pb-6 shadow-md">

                            <!-- <h3 class="text-xl font-bold mb-4 text-vet-black">Recent Orders</h3> -->

                            <table class="w-full text-left">
                                <thead class="bg-gray-100 text-gray">
                                    <tr>
                                        <th class="p-2">Product</th>
                                        <th class="p-2">Category</th>
                                        <th class="p-2">Price</th>
                                        <th class="p-2">Stock</th>
                                        <th class="p-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white text-common-gray divide-light-gray-border divide-y mb-1">

                                    <?php foreach ($data['products'] as $product) { ?>                                
                                        <tr>
                                            <td class="p-2 text-sm cursor-pointer"><?=$product['product']?></td>
                                            <td class="p-2 text-sm cursor-pointer"><?=$product['category']?></td>
                                            <td class="p-2 text-sm cursor-pointer">Kes <?=$product['price']?></td>
                                            <td class="p-2 text-sm cursor-pointer"><?=$product['stock']?></td>
                                            <td class="text-xs cursor-pointer">
                                                <div class="flex items-center space-x-2 justify-center">
                                                    <a class="text-quick-gray text-xs" href="/account?view=product&action=update&id=<?=$product['productId']?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                    </a>
                                                    <span class="text-red-800 text-xs text-red">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                    </span>
                                                </div>
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