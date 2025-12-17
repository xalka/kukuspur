<?php if(!ReqAjax()) require BASE_DIR.'inc/header.php'; ?>

<section class="grid place-items-center">

    <div class="bg-white max-w-[25rem] w-full my-10 py-4 px-10 rounded-lg pb-16 border border-off-white">

        <h6 class="text-xl text-gray-text text-center my-8">Payment</h6>

        <form action="/order?action=payment&orderId=<?=$data['order']['orderId']?>" method="post">
            
            <label>Amount</label>
            <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow mb-6">
                <input type="text" name="amount" class="input" value="<?=$data['order']['total']?>" readonly/>
            </div>

            <label>Phone</label>
            <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow mb-6">
                <input type="text" name="phone" class="input" placeholder="Mpesa Number" required/>
            </div>

            <button class="primary-button text-center w-full mt-2 mb-6">
                Pay Now Kes <?=$data['order']['total']?>
            </button>

            <div class="flex items-center justify-between text-sm mt-6">
                <a href="/order?action=payment" class="text-blue">
                    Change payment mode
                </a>
            </div>
            
        </form>

    </div>

</section>

<?php if(!ReqAjax()) require BASE_DIR.'inc/footer.php'; ?>