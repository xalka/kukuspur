<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">
        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[1.5rem] p-0 m-0">Dashboard</h2>

                <div class="category-widget flex items-center rounded-[5px] mt-5 py-4 px-2.5 hidden">
                    <!-- top light blue section -->
                    <div class="text-sm text-common-gray font-semibold tracking-[-0.375px]">
                        6,199 Items Found
                    </div>

                    <div class="ml-auto text-quick-gray flex gap-[1.875rem] items-center">
                        <div class="lg:flex items-center max-w-[15rem] w-full gap-2 hidden">
                            <div class="text-xs tracking-[-0.375px] font-medium">SORT BY</div>
                            <input type="text" placeholder="Relevance"
                                class="rounded h-[1.438rem] ps-2 input-control text-xs tracking-[-0.3px]" />
                        </div>

                        <div class="flex items-center space-x-2.5">
                            <div class="text-xs tracking-[-0.375px] font-medium">GRID</div>
                            <button class="border">
                                <svg xmlns="http://www.w3.org/2000/svg" class="rotate-90" width="36" height="23"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9 20h13v-4H9zM2 8h5V4H2zm0 6h5v-4H2zm0 6h5v-4H2zm7-6h13v-4H9zm0-6h13V4H9z" />
                                </svg>
                            </button>
                            <button class="border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="23" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9 20h13v-4H9zM2 8h5V4H2zm0 6h5v-4H2zm0 6h5v-4H2zm7-6h13v-4H9zm0-6h13V4H9z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
            
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-2 font-sans">
                        <!-- <h1 class="text-2xl font-bold text-vet-black mb-6">Welcome back, Jane!</h1> -->

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 hidden">
                            <!-- Orders -->
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <p class="text-sm text-common-gray mb-2">Total Orders</p>
                                <h2 class="text-2xl font-bold text-vet-black">1,250</h2>
                            </div>

                            <!-- Revenue -->
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <p class="text-sm text-common-gray mb-2">Revenue</p>
                                <h2 class="text-2xl font-bold text-vet-black">Kes 42,300</h2>
                            </div>

                            <!-- Pending Shipments -->
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <p class="text-sm text-common-gray mb-2">Pending Shipments</p>
                                <h2 class="text-2xl font-bold text-yellow">32</h2>
                            </div>

                            <!-- Returns -->
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <p class="text-sm text-common-gray mb-2">Returns</p>
                                <h2 class="text-2xl font-bold text-red">5</h2>
                            </div>
                        </div>

                        <div class="mt-5 bg-white rounded-xl p-6 shadow-md">

                            <h3 class="text-xl mb-4 text-vet-black">Recent Orders</h3>

                            <table class="w-full text-left text-sm">
                                <thead class="text-gray uppercase border-b border-shalow-gray">
                                    <tr>
                                        <th class="p-2">Order</th>
                                        <th class="p-2">Subtotal</th>
                                        <th class="p-2">Discount</th>
                                        <th class="p-2">Tax</th>
                                        <th class="p-2">Shipping</th>
                                        <th class="p-2">Total</th>
                                        <th class="p-2">Status</th>
                                        <th class="p-2">Time</th>
                                        <th class="p-2">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-common-gray">
                                <?php foreach ($data['orders'] as $order) { ?>
                                    <tr class="border-b border-light-gray p-2">
                                        <td class="p-2">#0<?=$order['orderId']?></td>
                                        <td class="p-2"><?=$order['subtotal']?></td>
                                        <td class="p-2"><?=$order['discount']?></td>
                                        <td class="p-2"><?=$order['tax']?></td>
                                        <td class="p-2"><?=$order['shipping']?></td>
                                        <td class="p-2"><?=$order['total']?></td>
                                        <td class="p-2"><span class="text-blue font-medium">Shipped</span></td>
                                        <td class="p-2"><?= date('Y-m-d',strtotime($order['created']))?></td>
                                        <td class="p-2"><?= date('H:i',strtotime($order['created']))?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="mt-5 bg-white rounded-xl p-6 shadow-md">

                            <h3 class="text-xl mb-4 text-vet-black">Recent Payments</h3>

                            <table class="w-full text-left text-sm">
                                <thead class="text-gray uppercase border-b border-shalow-gray">
                                    <tr>
                                        <th class="p-2">Payment ID</th>
                                        <th class="p-2">Name</th>
                                        <th class="p-2">Order ID</th>
                                        <th class="p-2">Status</th>
                                        <th class="p-2">Mode</th>
                                        <th class="p-2">Amount</th>
                                        <th class="p-2">Time</th>
                                        <th class="p-2">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-common-gray">
                                <?php foreach ($data['payments'] as $payment) { ?>
                                    <tr class="border-b border-light-gray">
                                        <td class="p-2">#<?=$payment['paymentId']?></td>
                                        <td class="p-2"><?=$payment['fname'].' '.$payment['lname']?></td>
                                        <td class="p-2">#<?=$payment['orderId']?></td>
                                        <td class="p-2 text-processing"><span><?=$payment['status']?></span></td>
                                        <td class="p-2"><?=$payment['mode']?></td>
                                        <td class="p-2"><?=$payment['amount']?></td>
                                        <td class="p-2"><?=$payment['time']?></td>
                                        <td class="p-2"><?=$payment['date']?></td>
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