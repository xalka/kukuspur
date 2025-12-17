<?php require BASE_DIR.'/inc/auth.header.php'; ?>

<!-- <div class="absolute flex h-full w-full pt-12 lg:pt-0 lg:items-center justify-center lg:justify-end bg-transparent">
    <div class="lg:mr-24 mx-5 max-h-[40rem] h-[38rem] w-[28rem] max-w-[30rem] rounded-lg bg-white px-8 pt-8 text-black">
        <div class="flex h-full flex-col items-center justify-between text-center">
            <div class="controls-section flex w-full flex-col items-center">

                <img src="/public/img/techpitch-logo.png" alt="TechPitch LOGO" class="w-[215px] h-auto" /> -->

                    <h1 class="mt-6 text-xl font-bold capitalize text-[#716F6F]">Verification</h1>

                    <form class="mt-8 w-full space-y-8" action="activate" method="POST">

                        <h1 class="capitalize text-[#716F6F]">
                            <div class="text-[11.25px] text-[#716F6F]">
                                <p>An email or SMS with verification code has been sent to you</p>
                                <!-- <span class="font-bold">+254 7*** *** *21</span> -->
                            </div>
                        </h1>                        

                        <div class="form-control focus-within:ring-1 focus-within:ring-blue-400">
                            <input type="text" placeholder="Enter Email" class="input-control" />
                            <div class="me-3.5 h-[22px] w-[20px] shrink-0">                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M4.616 19q-.691 0-1.153-.462T3 17.384V6.616q0-.691.463-1.153T4.615 5h14.77q.69 0 1.152.463T21 6.616v10.769q0 .69-.463 1.153T19.385 19zM12 11.96q.125 0 .234-.038q.108-.038.214-.093l7.229-4.733q.142-.086.185-.235t-.016-.297q-.038-.193-.252-.28q-.213-.086-.413.035L12 11L4.82 6.32q-.2-.122-.404-.052t-.262.276q-.058.154-.015.313t.184.24l7.229 4.732q.106.055.214.093q.109.037.234.037" />
                                </svg>
                            </div>
                        </div>

                        <button class="flex w-full items-center justify-center rounded-md bg-[#1D9D22] py-2 text-white" type="submit">
                            Reset
                        </button>

                        <div class="flex items-center justify-between text-sm text-[#8F8888]">
                            
                            <a href="/login"><span>Login</span></a>
                            <a href="/register"><span>Create Account</span></a>
                        </div>
                        
                    </form>

            <!-- </div>

            <div class="card-footer mb-8 text-xs font-medium text-[#8F8888]">
                Copyright © 2024 Company Ltd - All rights reserved ®
            </div>
        </div>
    </div>
</div> -->

<?php require BASE_DIR.'/inc/auth.footer.php'; ?>
