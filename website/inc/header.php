 <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/img/assets/favicon.ico">
    <link rel="stylesheet" href="/public/css/style.css" />
    <title>E-vet</title>
</head>

<body>

    <!-- <section class="fixed z-50 top-0 inset-x-0"> -->
    <section class="">
        
        <!-- start top-nav -->
        <header class="bg-vet-black lg:pt-6 pt-2.5 lg:pb-5 pb-0">
            <!-- flex-wrap to allow wrapping on small screens -->
                <div class="lg:container flex flex-wrap lg:flex-nowrap items-center justify-between w-full">

                    <div class="flex flex-row gap-2 px-4">
                        <button type="button" class="lg:hidden size-[30px] shrink-0 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="30" viewBox="0 0 29 25" fill="none">
                                <path d="M1.03571 4.59184H27.9643C28.5363 4.59184 29 4.13501 29 3.57143V1.02041C29 0.456824 28.5363 0 27.9643 0H1.03571C0.463676 0 0 0.456824 0 1.02041V3.57143C0 4.13501 0.463676 4.59184 1.03571 4.59184ZM1.03571 14.7959H27.9643C28.5363 14.7959 29 14.3391 29 13.7755V11.2245C29 10.6609 28.5363 10.2041 27.9643 10.2041H1.03571C0.463676 10.2041 0 10.6609 0 11.2245V13.7755C0 14.3391 0.463676 14.7959 1.03571 14.7959ZM1.03571 25H27.9643C28.5363 25 29 24.5432 29 23.9796V21.4286C29 20.865 28.5363 20.4082 27.9643 20.4082H1.03571C0.463676 20.4082 0 20.865 0 21.4286V23.9796C0 24.5432 0.463676 25 1.03571 25Z" fill="white" />
                            </svg>
                        </button>

                        <div class="lg:mb-0 mb-2.5 lg:ml-0 ml-4 lg:mx-0 order-1">
                            <a href="/" class="shrink-0 lg:mb-0 mb-[22px]">
                                <img src="/public/img/e-vet-logo.svg" alt="E-VET Logo Picture" class="w-[155px] h-[47px] lg:w-[223px] lg:h-[68px]" />
                            </a>
                        </div>

                    </div>

                    <!-- start filters -->
                    <div class="flex items-center gap-8 order-3 lg:order-2 w-full lg:w-auto">
                        <div class="lg:flex w-full pr-[20px] py-1 rounded-[5px] text-white hidden">
                        
                            <!-- <select name="filter" id="filter" class="ps-2.5 pe-3.5 text-xl font-semibold hidden">
                                <option selected="selected" value="">All Categories</option>
                                <?php foreach ($data['categories'] as $category) { ?>
                                    <option value="<?=$category['categoryId']?>"><?=$category['category']?></option>
                                <?php } ?>
                            </select> -->

                            <form class="max-w-sm mx-auto">

                                <div class="relative group inline-block">
                                    <div class="rounded-full flex items-center justify-center cursor-pointer">
                                        <button id="states-button" data-dropdown-toggle="dropdown-states"
                                            class="bg-blue text-white border border-blue rounded-md z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center w-auto"
                                            type="button">
                                            All categories
                                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="absolute right-0 -mt-1 bg-white border border-gray-200 rounded-lg shadow-lg hidden group-hover:block z-50 text-xs min-w-full whitespace-nowrap">
                                        <?php foreach ($data['categories'] as $category) { ?>
                                            <a href="/category?id=<?= $category['categoryId'] ?>"
                                                class="block px-4 py-1 text-[#1f2122] hover:bg-gray-100 rounded-lg hover:text-[#758186]">
                                                <?= $category['category'] ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>


                            </form>                            

                        </div>

                        <div class="w-full lg:py-0 py-[13px]  lg:rounded-[8px] lg:px-0 px-4 bg-white">
                            <div class="relative flex items-center lg:w-[26.3125rem] w-full rounded-[8px] focus-within:ring-2 focus-within:ring-blue border border-light-gray-border">
                                <div class="text-gray-text hidden lg:block lg:w-[8.125rem] xl:w-[9.125rem] shrink-0 text-[0.8125rem] py-2 px-[15px] border-r border-r-deep-gray-border">
                                    Search Category
                                </div>
                                <input type="text" class="w-[calc(100%-48px)] lg:w-auto rounded-r lg:flex-grow py-2 border-none focus:outline-none focus:border-none ps-3.5 text-[0.8125rem] text-gray-text" placeholder="Search here">
                                    <button class="absolute right-0 inset-y-0 px-3.5 border-l border-l-deep-gray-border">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                                            <path d="M14.9553 12.4919H14.0415L13.7176 12.1852C14.8512 10.8906 15.5337 9.20991 15.5337 7.38156C15.5337 3.30467 12.1676 0 8.01494 0C3.86229 0 0.496216 3.30467 0.496216 7.38156C0.496216 11.4584 3.86229 14.7631 8.01494 14.7631C9.87727 14.7631 11.5892 14.0931 12.9079 12.9802L13.2202 13.2982V14.1953L17.2501 18L18.8307 16.4483L14.9553 12.4919ZM8.01494 12.4919C5.13469 12.4919 2.80967 10.2093 2.80967 7.38156C2.80967 4.55385 5.13469 2.27125 8.01494 2.27125C10.8952 2.27125 13.2202 4.55385 13.2202 7.38156C13.2202 10.2093 10.8952 12.4919 8.01494 12.4919Z" fill="#36C6F3" />
                                        </svg>
                                    </button>
                            </div>
                        </div>
                    </div>
                    <!-- end filters -->

                    <div class="flex items-center gap-5 lg:mr-0 mr-4 order-2 lg:order-3">
                    
                    <?php if(isset($_SESSION[SESSION_KEY]['fname'])): ?>
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg> -->
                        <!-- <a href="/logout" class="rounded-[3px] text-[0.6875rem] text-white bg-blue p-2.5 xl:block hidden"> 
                            <span></span>
                        </a> -->

                        <div class="relative group">
                            <div class="rounded-full flex items-center justify-center cursor-pointer">
                                <svg class="text-gray-400 w-8 h-8 text-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6m0 14c-2.03 0-4.43-.82-6.14-2.88a9.95 9.95 0 0 1 12.28 0C16.43 19.18 14.03 20 12 20"/>
                                </svg>
                            </div>
                            
                            <div class="absolute right-0 -mt-1 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden group-hover:block z-50 text-sm">
                                <a href="/account" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg hover:text-[#36C6F3]">Account</a>
                                <a href="/logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg hover:text-[#36C6F3]">Logout</a>
                            </div>
                        </div>                        

                    <?php else: ?>
                        <a href="/login" class="rounded-[3px] text-[0.6875rem] text-white bg-blue p-2.5 xl:block hidden">Sign In</a>
                    <?php endif; ?>
                        <div class="flex items-center space-x-4">
                            <button class="shrink-0 w-[31px] h-[27px]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="27" viewBox="0 0 31 27" fill="none">
                                    <path d="M26.9545 16.6667H11.4029L11.7501 18.3333H25.99C26.807 18.3333 27.4126 19.0782 27.2315 19.8604L26.9388 21.1247C27.9304 21.5973 28.6141 22.5952 28.6141 23.75C28.6141 25.3751 27.2603 26.6898 25.5996 26.6664C24.0174 26.644 22.7162 25.3835 22.6735 23.8306C22.6502 22.9823 22.9963 22.2134 23.5649 21.6666H12.4429C12.9934 22.1961 13.3354 22.9336 13.3354 23.75C13.3354 25.4069 11.9281 26.7412 10.2229 26.6634C8.70881 26.5944 7.47744 25.3934 7.39786 23.9073C7.33643 22.7597 7.9515 21.7482 8.886 21.2206L5.15931 3.33333H1.45194C0.748746 3.33333 0.178711 2.7737 0.178711 2.08333V1.25C0.178711 0.559635 0.748746 0 1.45194 0H6.89122C7.49606 0 8.01739 0.41776 8.13861 0.999479L8.62488 3.33333H29.4624C30.2795 3.33333 30.885 4.07818 30.704 4.86036L28.1961 15.6937C28.0644 16.2628 27.549 16.6667 26.9545 16.6667ZM21.8236 8.75H19.2771V6.66667C19.2771 6.20641 18.8971 5.83333 18.4283 5.83333H17.5795C17.1107 5.83333 16.7307 6.20641 16.7307 6.66667V8.75H14.1842C13.7154 8.75 13.3354 9.12307 13.3354 9.58333V10.4167C13.3354 10.8769 13.7154 11.25 14.1842 11.25H16.7307V13.3333C16.7307 13.7936 17.1107 14.1667 17.5795 14.1667H18.4283C18.8971 14.1667 19.2771 13.7936 19.2771 13.3333V11.25H21.8236C22.2924 11.25 22.6724 10.8769 22.6724 10.4167V9.58333C22.6724 9.12307 22.2924 8.75 21.8236 8.75Z" fill="#36C6F3" />
                                </svg>
                            </button>
                            <span class="text-red font-semibold text-xl -ml-3 cart-item-count">
                                <a href="/cart">
                                    <?=array_sum(array_column($_SESSION['cart'],'qty'));?>
                                </a>
                            </span>
                        </div>
                    </div>

                </div>
        </header>
        <!-- end top-nav -->

        <!-- start main navigation -->
        <!--header class="lg:grid place-items-center h-[42px] bg-blue text-white hidden">
            <nav>
                <ul class="flex items-center gap-8 text-lg *:tracking-[-1.2px] text-center">
                    <li><a href="/">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Hot Sale</a></li>
                    <li><a href="#">New Products</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </nav>
        </header-->
        <!-- end main navigation -->
    </section>
    
    <div class="main-content">