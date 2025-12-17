<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <main class="pt-4 text-gray">
        <div class="bread-crubs container">
            <ul class="bread-crumbs flex items-center text-sm pb-[0.63rem] border-b border-b-standard-gray">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#" class="active">Category</a></li>
                <li><a href="#">Sub-category</a></li>
            </ul>

            <section class="flex flex-col lg:flex-row mt-5 gap-5">
                <div class="grow flex flex-col gap-y-5">
                    <h1 class="lg:leading-[50.24px] lg:text-3xl text-xl font-light"><?=$data['product']['detail']['product']?></h1>

                    <div class="grid lg:grid-cols-2 place-items-stretch gap-5">
                        <div class="col-1 space-y-3">
                            <div class="max-w-full w-full">
                                <img src="/public/img/uploads/<?=$data['product']['images'][0]['img']?>" alt="" width="483" height="442"
                                    class="object-cover w-full">
                            </div>
                            <div class="flex gap-2.5 items-center">
                            <?php foreach ($data['product']['images'] as $image) { ?>
                                <img src="/public/img/uploads/<?=$image['img']?>" width="93" height="86" alt="" class="shadow-lg">
                            <?php } ?>
                            </div>
                        </div>

                        <div class="col-2 item-details">
                            <h2 class="text-2xl font-bold text-blue">KES <?=$data['product']['detail']['price']?></h2>
                            <?php if($data['product']['detail']['discount'] > 0) { ?>
                                <div class="flex items-center gap-2 font-semibold">
                                    <span class="text-lg text-standard-gray font-medium">
                                        <s>KES <?=$data['product']['detail']['price']?></s>
                                    </span>
                                    <span class="text-base text-red font-medium"><?=$data['product']['detail']['discount']?>% off</span>
                                </div>
                            <?php } ?>
                            <h6 class="text-sm text-gray my-2"><?=$data['product']['detail']['stock']?> In Stock</h6>
                            <article class="text-standard-gray space-y-1 border-b border-b-grayed pb-4">
                                <h2 class="text-xl font-semibold">Short Description</h2>
                                <p class="text-sm"><?=$data['product']['detail']['descrp']?></p>
                            </article>

                            <div class="flex items-center gap-2.5 text-gray text-[0.7375rem] my-4">
                                Reviews 21
                                <div class="flex items-center text-yellow gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-opacity="0"
                                            d="M12 3l2.35 5.76l6.21 0.46l-4.76 4.02l1.49 6.04l-5.29 -3.28l-5.29 3.28l1.49 -6.04l-4.76 -4.02l6.21 -0.46Z">
                                            <animate fill="freeze" attributeName="fill-opacity" begin="0.5s" dur="0.5s"
                                                values="0;1" />
                                        </path>
                                        <path fill="none" stroke="currentColor" stroke-dasharray="36" stroke-dashoffset="36" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l-2.35 5.76l-6.21 0.46l4.76 4.02l-1.49 6.04l5.29 -3.28M12 3l2.35 5.76l6.21 0.46l-4.76 4.02l1.49 6.04l-5.29 -3.28">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s"
                                                values="36;0" />
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-opacity="0"
                                            d="M12 3l2.35 5.76l6.21 0.46l-4.76 4.02l1.49 6.04l-5.29 -3.28l-5.29 3.28l1.49 -6.04l-4.76 -4.02l6.21 -0.46Z">
                                            <animate fill="freeze" attributeName="fill-opacity" begin="0.5s" dur="0.5s"
                                                values="0;1" />
                                        </path>
                                        <path fill="none" stroke="currentColor" stroke-dasharray="36"
                                            stroke-dashoffset="36" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 3l-2.35 5.76l-6.21 0.46l4.76 4.02l-1.49 6.04l5.29 -3.28M12 3l2.35 5.76l6.21 0.46l-4.76 4.02l1.49 6.04l-5.29 -3.28">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s"
                                                values="36;0" />
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-opacity="0"
                                            d="M12 3l2.35 5.76l6.21 0.46l-4.76 4.02l1.49 6.04l-5.29 -3.28l-5.29 3.28l1.49 -6.04l-4.76 -4.02l6.21 -0.46Z">
                                            <animate fill="freeze" attributeName="fill-opacity" begin="0.5s" dur="0.5s"
                                                values="0;1" />
                                        </path>
                                        <path fill="none" stroke="currentColor" stroke-dasharray="36"
                                            stroke-dashoffset="36" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 3l-2.35 5.76l-6.21 0.46l4.76 4.02l-1.49 6.04l5.29 -3.28M12 3l2.35 5.76l6.21 0.46l-4.76 4.02l1.49 6.04l-5.29 -3.28">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s"
                                                values="36;0" />
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-opacity="0"
                                            d="M12 3l-2.35 5.76l-6.21 0.46l4.76 4.02l-1.49 6.04l5.29 -3.28Z">
                                            <animate fill="freeze" attributeName="fill-opacity" begin="0.5s" dur="0.5s"
                                                values="0;1" />
                                        </path>
                                        <path fill="none" stroke="currentColor" stroke-dasharray="36"
                                            stroke-dashoffset="36" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 3l-2.35 5.76l-6.21 0.46l4.76 4.02l-1.49 6.04l5.29 -3.28M12 3l2.35 5.76l6.21 0.46l-4.76 4.02l1.49 6.04l-5.29 -3.28">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s"
                                                values="36;0" />
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <div class="text-gray text-[0.7375rem] space-y-0.5">
                                <h4>Item(s)</h4>
                                <div class="flex items-center border-2 border-off-white text-standard-gray rounded-md w-fit py-1 px-2 bg-white">
                                    <button type="button" data-decrease="<?=$data['product']['detail']['productId']?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19 12.998H5v-2h14z" />
                                        </svg>
                                    </button>
                                    <span class="mx-2.5">
                                        <input name="qty" type="text" value="0" placeholder="0" class="w-6 text-center" data-productId="<?=$data['product']['detail']['productId']?>"/>
                                    </span>
                                    <button type="button" data-increase="<?=$data['product']['detail']['productId']?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex gap-5 mt-6">
                                <button class="primary-button" data-buy="<?=$data['product']['detail']['productId']?>">
                                    Buy Now
                                </button>
                                <button class="secondary-button" data-add-cart="<?=$data['product']['detail']['productId']?>">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- start tabs -->


                    <div class="mt-8 border-b border-gray-200 text-standard-gray">
                        <ul class="tabs flex flex-wrap -mb-px text-sm font-medium text-center *:font-bold" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">

                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg text-standard-gray"
                                    id="description-tab" data-tabs-target="#description" type="button" role="tab"
                                    aria-controls="description" aria-selected="false">Description</button>
                            </li>

                            <li class="me-2 hidden" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-standard-gray"
                                    id="specs-tab" data-tabs-target="#specs" type="button" role="tab"
                                    aria-controls="specs" aria-selected="false">Specs</button>
                            </li>

                            <li class="me-2 hidden" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-standard-gray"
                                    id="short-escription-tab" data-tabs-target="#short-escription" type="button"
                                    role="tab" aria-controls="short-escription" aria-selected="false">Short
                                    Description</button>
                            </li>

                        </ul>

                        <!-- <div class="flex space-x-2 border-b mb-4">
                            <button class="tab-button text-sm font-medium py-2 px-4 border-b-2 border-blue-500 text-blue-600">Tab 1</button>
                            <button class="tab-button text-sm font-medium py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-blue-600">Tab 2</button>
                            <button class="tab-button text-sm font-medium py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-blue-600">Tab 3</button>
                        </div> -->

                    </div>

                    <div class="text-standard-gray">

                        <div class="tab-content block">
                            <?=$data['product']['detail']['descrp']?>
                        </div>

                        <div class="tab-content hidden">
                            <p>This is content for Tab 2.</p>
                        </div>

                        <div class="tab-content hidden">
                            <p>This is content for Tab 3.</p>
                        </div>                

                        <!--div class="hidden px-4 text-sm" id="description" role="tabpanel" aria-labelledby="description-tab">

                            <p class="leading-relaxed tracking-[-2.5%]">Description Ipsum is simply dummy text of the
                                printing
                                and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                                a type specimen book. It has survived not only five centuries, but also the leap into
                                electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>

                            <div class="my-8 max-h-[19.75rem] h-[19.75rem]">
                                <div class="inline-banner w-full h-full bg-no-repeat bg-cover bg-center"></div>
                            </div>

                            <h5 class="font-bold text-sm">Customer Reviews (43)</h5>

                        </div>

                        <div class="hidden px-4" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                            <p class="leading-relaxed tracking-[-2.5%]">Specs Ipsum is simply dummy text of the printing
                                and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                                a type specimen book. It has survived not only five centuries, but also the leap into
                                electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>

                        <div class="hidden px-4" id="short-escription" role="tabpanel" aria-labelledby="short-escription-tab">

                            <p class="leading-relaxed tracking-[-2.5%]">Short description Ipsum is simply dummy text of
                                the printing
                                and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                                a type specimen book. It has survived not only five centuries, but also the leap into
                                electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>

                        </div-->

                    </div>

                    <!-- <div class="flex space-x-2 border-b mb-4">
                        <button class="tab-button text-sm font-medium py-2 px-4 border-b-2 border-blue-500 text-blue-600">Tab 1</button>
                        <button class="tab-button text-sm font-medium py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-blue-600">Tab 2</button>
                        <button class="tab-button text-sm font-medium py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-blue-600">Tab 3</button>
                    </div> -->

                    <!-- <div class="tab-content block">
                        <?=$data['product']['detail']['descrp']?>
                    </div>

                    <div class="tab-content hidden">
                        <p>This is content for Tab 2.</p>
                    </div>

                    <div class="tab-content hidden">
                        <p>This is content for Tab 3.</p>
                    </div> -->
                    
                </div>

                <aside class="never-shrink max-w-[23.3125rem] w-full shopping-cart">
                    <div class="w-full bg-gray-border/30 py-8 px-5 rounded-md hidden <?php if(empty($data['cart'])){?> hidden <?php }?>">
                        <h3 class="font-semibold">My cart</h3>

                        <div class="flex flex-col divide-y divide-grayed border-y border-y-grayed mt-1.5">
                        <?php foreach ($data['cart'] as $product) { ?>
                            <figure class="relative flex items-start gap-2.5 w-full py-[0.55rem]">
                                <div class="h-[3.4375rem] w-[3.3456rem] border border-light-gray rounded never-shrink">
                                    <img src="/public/img/uploads/<?=$product['img']?>" alt="<?=$product['title']?>" class="bg-cover w-full h-auto" />
                                </div>
                                <figcaption class="text-[0.8375rem] pr-4 flex flex-col gap-y-2.5">
                                    <article class="content">
                                        <p class="line-clamp-3"><?=$product['product']?></p>
                                    </article>

                                    <div
                                        class="flex items-center border-2 border-off-white text-standard-gray rounded-md w-fit py-1 px-2 bg-white">
                                        <button type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19 12.998H5v-2h14z" />
                                            </svg>
                                        </button>
                                        <span class="mx-2.5"><?=$product['qty']?></span>
                                        <button type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <strong>KES <?=$product['price']?></strong>
                                </figcaption>

                                <button type="button" class="absolute right-0 text-red">
                                    <!-- <img src="public/img/delete-icon.png" alt="" class="size-3.5"> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M5 21V6H4V4h5V3h6v1h5v2h-1v15zm2-2h10V6H7zm2-2h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                    </svg>
                                </button>
                            </figure>
                        <?php } ?>
                        </div>

                        <div class="mt-4 space-y-6">
                            <div class="space-y-1">
                                <h3 class="text-standard-gray font-semibold text-[0.9375rem]">Total Amount</h3>
                                <h2 class="text-blue tracking-[-2.5%] leading-[31.4px] text-xl font-bold">KES462.00</h2>
                            </div>

                            <button
                                class="never-shrink py-3 w-full border border-blue rounded-md bg-light-blue text-lg">
                                View Cart
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2.5 mt-11">
                        <h2 class="text-xl px-5"><span class="font-bold">Related</span> Products</h2>

                        <!-- <article class="flex items-start gap-2.5 border-t border-t-grayed mt-2 pt-2">

                        </article> -->
                        <div class="flex flex-col divide-y divide-grayed border-t border-t-grayed mt-1.5 px-5">

                        <?php foreach ($data['related'] as $product) { ?>

                            <a class="flex items-start gap-5 w-full py-4" href="/product?id=<?=$product['productId']?>">
                                <div class="h-[5.1875rem] w-[5.575rem] border border-light-gray rounded never-shrink">
                                    <img src="/public/img/uploads/<?=$product['img']?>" alt="Tap Picture"
                                        class="bg-cover w-full h-auto" />
                                </div>
                                <figcaption class="text-[0.8375rem] pr-4 flex flex-col gap-y-2.5">
                                    <article class="content">
                                        <h6><strong><?=$product['product']?></strong></h6>
                                        <p><?=$product['product']?></p>
                                        <p class="text-base">Was:
                                            <span class="text-xs">shs.</span>
                                            <span class="text-sm"><?=$product['price']?></span>
                                            <br />
                                            <span class="text-red">sh.<s><?=$product['price']?></s></span>
                                            <span class="text-red font-bold"> (<?=$product['discount']?> % off)</span>
                                            <br />
                                            <span class="text-standard-gray text-sm">Offer price: <?=$product['price']?></span>
                                        </p>
                                    </article>
                                </figcaption>
                            </a>
                            
                        <?php } ?>

                        </div>
                    </div>
                </aside>
            </section>
        </div>


        <!-- start featured products section -->
        <section class="featured-products bg-deep-gray pt-[2.375rem] lg:py-[3.375rem] mt-[2.375rem]">
            <div class="container">
                <h2 class="text-gray text-2xl mb-[1.785rem] font-bold tracking-[0.8px]">Your shopping history</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:grid-cols-5 lg:gap-[1.0625rem]">
                    <div class="card-wrapper">
                        <div class="card-media">
                            <img src="public/img/easy-cleaner-Brush-2.jpg" class="card-image" alt="Easy Cleaner Brush">
                        </div>

                        <div class="card-content">
                            <h5 class="card-title">Buda Jeans Co</h5>

                            <article class="card-body">
                                <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]">Panelled Low-Top lace Up
                                    Sneakers</p>
                                <p class="text-sm leading-[-0.07px]">
                                    sh.2,099
                                    <span class="text-red text-[0.8125rem]">
                                        <span class="line-through">sh.3,499</span>
                                        <span class="font-bold">(40%off)</span>
                                    </span>
                                </p>
                                <p class="text-gray text-sm">offer price sh.1,750</p>
                            </article>
                        </div>
                    </div>
                    <div class="card-wrapper">
                        <div class="card-media">
                            <img src="public/img/water-pump-SM100A-150A.jpg" class="card-image"
                                alt="Easy Cleaner Brush">
                        </div>

                        <div class="card-content">
                            <h5 class="card-title">Buda Jeans Co</h5>

                            <article class="card-body">
                                <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]">Panelled Low-Top lace Up
                                    Sneakers</p>
                                <p class="text-sm leading-[-0.07px]">
                                    sh.2,099
                                    <span class="text-red text-[0.8125rem]">
                                        <span class="line-through">sh.3,499</span>
                                        <span class="font-bold">(40%off)</span>
                                    </span>
                                </p>
                                <p class="text-gray text-sm">offer price sh.1,750</p>
                            </article>
                        </div>
                    </div>
                    <div class="card-wrapper">
                        <div class="card-media">
                            <img src="public/img/Dough-Mixers-KM06019.jpg" class="card-image" alt="Easy Cleaner Brush">
                        </div>

                        <div class="card-content">
                            <h5 class="card-title">Buda Jeans Co</h5>

                            <article class="card-body">
                                <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]">Panelled Low-Top lace Up
                                    Sneakers</p>
                                <p class="text-sm leading-[-0.07px]">
                                    sh.2,099
                                    <span class="text-red text-[0.8125rem]">
                                        <span class="line-through">sh.3,499</span>
                                        <span class="font-bold">(40%off)</span>
                                    </span>
                                </p>
                                <p class="text-gray text-sm">offer price sh.1,750</p>
                            </article>
                        </div>
                    </div>
                    <div class="card-wrapper">
                        <div class="card-media">
                            <img src="public/img/Agribox-Pro-a.jpg" class="card-image" alt="Easy Cleaner Brush">
                        </div>

                        <div class="card-content">
                            <h5 class="card-title">Buda Jeans Co</h5>

                            <article class="card-body">
                                <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]">Panelled Low-Top lace Up
                                    Sneakers</p>
                                <p class="text-sm leading-[-0.07px]">
                                    sh.2,099
                                    <span class="text-red text-[0.8125rem]">
                                        <span class="line-through">sh.3,499</span>
                                        <span class="font-bold">(40%off)</span>
                                    </span>
                                </p>
                                <p class="text-gray text-sm">offer price sh.1,750</p>
                            </article>
                        </div>
                    </div>
                    <div class="card-wrapper">
                        <div class="card-media">
                            <img src="public/img/Monameter-63-mm.jpg" class="card-image" alt="Easy Cleaner Brush">
                        </div>

                        <div class="card-content">
                            <h5 class="card-title">Buda Jeans Co</h5>

                            <article class="card-body">
                                <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]">Panelled Low-Top lace Up
                                    Sneakers</p>
                                <p class="text-sm leading-[-0.07px]">
                                    sh.2,099
                                    <span class="text-red text-[0.8125rem]">
                                        <span class="line-through">sh.3,499</span>
                                        <span class="font-bold">(40%off)</span>
                                    </span>
                                </p>
                                <p class="text-gray text-sm">offer price sh.1,750</p>
                            </article>
                        </div>
                    </div>
                    <div class="card-wrapper hidden">
                        <div class="card-media">
                            <img src="public/img/MIK-chess-600x600-1.jpg" class="card-image" alt="Easy Cleaner Brush">
                        </div>

                        <div class="card-content">
                            <h5 class="card-title">Buda Jeans Co</h5>

                            <article class="card-body">
                                <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]">Panelled Low-Top lace Up
                                    Sneakers</p>
                                <p class="text-sm leading-[-0.07px]">
                                    sh.2,099
                                    <span class="text-red text-[0.8125rem]">
                                        <span class="line-through">sh.3,499</span>
                                        <span class="font-bold">(40%off)</span>
                                    </span>
                                </p>
                                <p class="text-gray text-sm">offer price sh.1,750</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end featured products section -->
    </main>


<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>