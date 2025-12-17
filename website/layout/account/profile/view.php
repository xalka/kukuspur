<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">
        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[1.5rem] p-0 m-0">Profile</h2>

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-6 font-sans ">

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6">

                        <!-- <div class="flex justify-center mt-6"> -->

                            <form action="/account?view=profile" method="post" class="space-y-2">

                                <!-- <div class="flex md:flex-row flex-col items-center gap-1 w-full"> -->
                                    <div class="grow form-control w-full input-fname">
                                        <label>First name</label>
                                        <div class="flex items-center rounded-lg normal-input shadow">
                                            <input type="text" name="fname" class="input mt-1" value="<?=$data['customer']['fname']?>" placeholder="First names" />
                                        </div>
                                        <span data-name="fname"></span>
                                        <!-- Add min-height and invisible by default to maintain space -->
                                        <!-- <div class="min-h-[1.6875rem]">
                                            <span class="error text-xs text-red-500 hidden">Please enter your first name.</span>
                                        </div> -->
                                    </div>

                                    <div class="grow form-control w-full input-lname">
                                        <label>Last name</label>
                                        <div class="flex items-center rounded-lg normal-input shadow">
                                            <input type="text" name="lname" class="input" value="<?=$data['customer']['lname']?>" placeholder="Last names"/>
                                        </div>
                                        <span data-name="lname"></span>
                                        <!-- <div class="min-h-[1.6875rem]">
                                            <span class="error text-xs text-red-500 hidden">Please enter your last name.</span>
                                        </div> -->
                                    </div>
                                <!-- </div> -->

                                <div class="form-control flex flex-col input-email">
                                    <label>Email</label>
                                    <div class="flex items-center rounded-lg normal-input shadow">
                                        <input type="text" name="email" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Email Address" value="<?=$data['customer']['email']?>" />
                                    </div>
                                    <span data-name="email"></span>
                                </div>

                                <div class="form-control flex flex-col input-phone">
                                    <label>Phone</label>
                                    <div class="flex items-center rounded-lg normal-input shadow">
                                        <input type="text" name="phone" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Phone Number" value="<?=$data['customer']['phone']?>"/>
                                    </div>
                                    <span data-name="phone"></span>
                                </div>

                                <div class="form-control flex flex-col hidden">
                                    <div class="flex items-center rounded-lg normal-input shadow">
                                        <input type="text" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Physical address" />
                                    </div>
                                    <!-- <span class="error">message</span> -->
                                </div>

                                <div class="form-control flex flex-col input-password">
                                    <label>Password</label>
                                    <div class="flex items-center rounded-lg focus-within:ring-1 focus-within:ring-blue pr-3.5 border border-blue shadow">
                                        <input type="password" name="password" class="input-control-reset grow rounded-lg placeholder:text-gray placeholder:text-xs" placeholder="Password" required/>
                                        <i class="text-gray cursor-pointer hidden">
                                            <!-- <img src="/public/img/lock-person.png" alt="Eye Closed Icon" aria-hidden="true" /> -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 password-toggle fa-eye-slash fa-eye" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.78 12.36a3 3 0 10-4.24-4.24m1.42 8.48A8.94 8.94 0 013 12c1.5-4.5 5-7.5 9-7.5s7.5 3 9 7.5a8.94 8.94 0 01-1.95 3.37M12 15.5a3 3 0 100-6 3 3 0 000 6z"></path>
                                            </svg>
                                            <!-- <div class="sr-only">Eye Closed Icon</div> -->
                                        </i>
                                    </div>
                                    <span data-name="password"></span>
                                </div>

                                <button type="submit" class="primary-button text-center w-full mt-2">
                                    Update Profile
                                </button>

                            </form>

                        </div>

                    </div>

                </div>
                
            </section>
            
        </div>
    </section>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>