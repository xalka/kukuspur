<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">

        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[1.5rem] p-0 m-0 .success-box">Payments</h2>

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-6 font-sans">
                        <!-- <h1 class="text-2xl font-bold text-vet-black mb-6">Welcome back, Jane!</h1> -->

                        <div class="bg-white rounded-xl px-4 pb-6 shadow-md">

                            <!-- <h3 class="text-xl font-bold mb-4 text-vet-black">Recent Orders</h3> -->

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
                                    <tr class="border-b border-light-gray text-capitalize">
                                        <td class="p-2">#<?=$payment['paymentId']?></td>
                                        <td class="p-2"><?=$payment['fname'].' '.$payment['lname']?></td>
                                        <td class="p-2">#<?=$payment['orderId']?></td>
                                        <td class="p-2">
                                            <span class="text-<?=str_replace(' ','',$payment['status'])?>"><?=$payment['status']?></span>
                                        </td>
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