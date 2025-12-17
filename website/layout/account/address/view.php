<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">
        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[1.5rem] p-0 m-0">Address</h2>

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-6 font-sans">

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <?php foreach ($data['addresses'] as $address) { ?>
                            
                            <!-- Address Card -->
                            <div class="bg-white border border-light-gray-border rounded-2xl p-5 shadow-lg hover:shadow-xl transition">
                                <div class="mb-2 flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Home</h3>
                                <?php if($address['defaultAddress']) { ?>
                                    <span class="px-2 py-0.5 text-xs font-medium text-green-600 bg-green-100 rounded-full">Default</span>
                                <?php } ?>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    <span class="capitalize"><?=$address['fname'].' '.$address['lname']?></span><br>
                                    <?=$address['phone']?><br>
                                    <?=$address['email']?>
                                </p>
                                <div class="mt-4 flex justify-between text-sm text-blue-600">
                                    <button class="text-blue">Edit</button>
                                    <button class="text-red">Delete</button>
                                    <button class="text-light-green">Set as Default</button>
                                </div>
                            </div>

                        <?php } ?>

                            <!-- Work Address -->
                            <!-- <div class="bg-white border border-light-gray-border rounded-2xl p-5 shadow-lg hover:shadow-xl transition">
                                <div class="mb-2 flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Work</h3>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    John Doe<br>
                                    456 Business Park Road<br>
                                    Mombasa, Kenya<br>
                                    Postal Code: 80100
                                </p>
                                <div class="mt-4 flex justify-between text-sm text-blue-600">
                                    <button class="hover:underline">Edit</button>
                                    <button class="hover:underline">Delete</button>
                                    <button class="hover:underline">Set as Default</button>
                                </div>
                            </div> -->

                            <!-- Add New Address -->
                            <a href="/account?view=address&action=create" class="border-2 border-gray-border border-dashed rounded-2xl p-5 text-center text-gray-500 flex items-center justify-center hover:border-blue-400 hover:text-blue-600 transition cursor-pointer">
                                <p class="text-sm font-medium">+ Add New Address</p>
                            </a>

                        </div>

                    </div>

                </div>
                
            </section>
            
        </div>
    </section>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>