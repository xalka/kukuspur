<?php if(!ReqAjax()) require BASE_DIR.'inc/header.php'; ?>

    <section class="grid place-items-center">

        <div class="bg-white max-w-[25rem] w-full my-10 py-4 px-10 rounded-lg pb-16 border border-off-white">

            <h6 class="text-xl text-gray-text text-center my-8">Verification</h6>

            <form action="/activate" method="post" class="space-y-6">

                <!-- <div class="border border-red rounded-md text-xs text-red p-1.5">
                    <p>Error: Email and Password not matching.</p>
                </div> -->

                <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow">
                    <input type="text" name="code" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Verification Code" />
                    <span aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                        </svg>
                    </span>
                </div>

                <button class="primary-button text-center w-full">
                    Verify
                </button>

            </form>
        
        </div>

    </section>

<?php if(!ReqAjax()) require BASE_DIR.'inc/footer.php'; ?>    