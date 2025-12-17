            <!-- start left section -->
            <aside class="side-nav lg:flex flex-col w-full lg:w-[24.063rem] lg:max-w-[24.063rem] hidden">

                <ul class="bread-crumbs flex items-center text-sm pb-[0.63rem] border-b border-b-standard-gray">
                    <li><a href="/" class="active">Home</a></li>
                    <li><a href="/account" class="active">Account</a></li>
                    <li><a href="/account?action=dashboard">Dashboard</a></li>
                </ul>

                <h3 class="h3 py-4">My Account</h3>

                <!-- <ul class="text-standard-gray border-y border-y-standard-gray *:py-1.5 divide-y divide-standard-gray font-bold text-sm *:tracking-[-0.4px]"> -->
                <ul class="text-standard-gray *:py-1.5 font-bold text-sm *:tracking-[-0.4px]">
                <?php 

                    $settings = [
                        ['title' => 'Dashboard', 'url' => 'dashboard', 'view' => [1,2,3,4,5,6,7] ],
                        ['title' => 'Orders', 'url' => 'order', 'view' => [1,2,3,4,5,6,7] ],
                        ['title' => 'Wishlist', 'url' => 'wishlist', 'view' => [1,2,3,4,5,6,7] ],
                        //['title' => 'Wallet', 'url' => 'wallet', 'view' => [1,2,3,4,5,6,7] ],
                        ['title' => 'Payments', 'url' => 'payment', 'view' => [1,2,3,4,5,6,7] ],
                        //['title' => 'Views', 'url' => 'view', 'view' => [2,3,4,5,6,7] ],
                        ['title' => 'Products', 'url' => 'product', 'view' => [2,3,4,5,6,7] ],
                        //['title' => 'Inbox', 'url' => 'inbox', 'view' => [1,2,3,4,5,6,7] ],
                        //['title' => 'Reviews', 'url' => 'review', 'view' => [2,3,4,5,6,7] ],
                        ['title' => 'Address', 'url' => 'address', 'view' => [1,2,3,4,5,6,7] ],
                        ['title' => 'Profile', 'url' => 'profile', 'view' => [1,2,3,4,5,6,7] ],
                    ];
                
                    foreach ($settings as $setting){
                        // if(in_array($sess['typeId'], $setting['view'])){
                ?>
                    <a class="w-full" href="/account?view=<?=$setting['url']?>">
                        <li class="p-2 border-b border-b-standard-gray"><?=$setting['title']?></li>
                    </a>
                    
                <?php } // } ?>
                </ul>

            </aside>
            <!-- end left section -->