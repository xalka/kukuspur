<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">
        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[1.5rem] p-0 m-0">Orders</h2>

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-6 font-sans">
                        <!-- <h1 class="text-2xl font-bold text-vet-black mb-6">Welcome back, Jane!</h1> -->

                        <div class="bg-white rounded-xl px-4 pb-6 shadow-md">

                            <!-- <h3 class="text-xl font-bold mb-4 text-vet-black">Recent Orders</h3> -->

                            <table class="w-full text-left text-sm">
                                <thead class="text-gray uppercase border-b border-shalow-gray">
                                    <tr>
                                        <th class="p-2">Order ID</th>
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

                    </div>

                </div>
                
            </section>
            
        </div>
    </section>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>