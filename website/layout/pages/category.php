
<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4">
        <div class="container flex lg:flex-row flex-col">
            <!-- start left section -->
            <aside class="side-nav lg:flex flex-col w-full lg:w-[24.063rem] lg:max-w-[24.063rem] hidden">

                <ul class="bread-crumbs flex items-center text-sm pb-[0.63rem] border-b border-b-standard-gray">
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#" class="active">Category</a></li>
                    <li><a href="#">Sub-category</a></li>
                </ul>

                <h3 class="h3 py-4">Sub-Category </h3>

                <ul class="text-standard-gray border-y border-y-standard-gray *:py-1.5 divide-y divide-standard-gray font-bold text-sm *:tracking-[-0.4px]">
                <?php foreach ($data['categories'] as $cat) { ?>
                    <li><a href="/category?id=<?=$cat['categoryId']?>"><?=$cat['category']?></a></li>
                <?php } ?>
                </ul>

                <h3 class="h3 pt-6">Discounts</h3>

                <div class="flex items-center mt-2 mb-4">
                    <input id="onsale-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-standard-gray rounded focus:ring-blue">
                    <label for="onsale-checkbox" class="ms-2 text-sm font-medium text-common-gray">On Sale</label>
                </div>

                <div class="border-t border-t-standard-gray mt-4">
                    <h3 class="h3 pb-2 pt-6">Prices</h3>

                    <div class="flex items-center gap-1 text-rare-gray">
                        <input type="text" placeholder="Kes" class="input-control flex-grow w-full" />
                        -
                        <input type="text" placeholder="Kes" class="input-control flex-grow w-full" />
                        <button
                            class="shrink-0 ml-[14px] border border-rare-gray text-white bg-blue w-[72px] h-[45px] text-sm font-semibold tracking-[-0.5px] pl-[23px] rounded-[5px]">
                            OK
                        </button>
                    </div>
                </div>
            </aside>
            <!-- end left section -->


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">
                <h1 class="tracking-[-2.4px] text-gray text-xl md:text-[2.5rem]">
                    <span class="font-bold">Category </span>
                    Products
                </h1>

                <div class="category-widget flex items-center rounded-[5px] mt-5 py-4 px-2.5">
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

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border">
                <?php foreach ($data['products'] as $product) { ?>

                    <a class="card-wrapper" href="/product?id=<?=$product['productId']?>">
                        <div class="card-media">
                            <img src="/public/img/uploads/<?=$product['img']?>" class="card-image" alt="Easy Cleaner Brush">
                        </div>

                        <div class="card-content">
                            <h5 class="card-title"><?=$product['product']?></h5>

                            <article class="card-body">
                                <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]"><?=$product['descrp']?></p>
                                <p class="text-sm leading-[-0.07px]">
                                    Kes <?=$product['price']?>
                                    <span class="text-red text-[0.8125rem]">
                                        <span class="line-through">sh.3,499</span>
                                        <span class="font-bold">(40%off)</span>
                                    </span>
                                </p>
                                <p class="text-gray text-sm">offer price sh.1,750</p>
                            </article>
                        </div>
                    </a>

                <?php } ?>



                    <!-- <div class="card-wrapper">
                        <div class="card-media">
                            <img src="public/img/teat-100mm-soft.jpg" class="card-image" alt="Easy Cleaner Brush">
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
                            <img src="public/img/inek-yatagi-KEWPlus-katman-3.jpg" class="card-image"
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
                            <img src="public/img/BEREKER-BS1.png" class="card-image" alt="Easy Cleaner Brush">
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
                            <img src="public/img/kurtsan-stainles-Milk-Churun-30-lt.jpg" class="card-image"
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
                            <img src="public/img/Emaye-suluk-Mod.-375-VA.jpg" class="card-image"
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
                            <img src="public/img/Tekerlek.jpg" class="card-image" alt="Easy Cleaner Brush">
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
                    </div> -->


                </div>

                <!-- start advertisement section -->
                <div class="relative w-full max-h-[20rem] mt-[3.014rem]">
                    <img src="public/img/TractorAd.jpg" class="w-full h-full object-cover" alt="TractorAd Picture">
                </div>
                <!-- end advertisement section -->
            </section>
            <!-- end right section -->
        </div>
    </section>

    <!-- start featured products section -->
    <section class="featured-products bg-deep-gray pt-[2.375rem] lg:py-[3.375rem] mt-[2.375rem]">
        <div class="container">
            <h2 class="text-gray text-2xl mb-[1.785rem] font-bold tracking-[0.8px]">Your shopping history</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:grid-cols-5 lg:gap-[1.0625rem]">
            <?php foreach ($data['history'] as $product) { ?>
                <a class="card-wrapper" href="/product?id=<?=$product['productId']?>">
                    <div class="card-media">
                        <img src="/public/img/uploads/<?=$product['img']?>" class="card-image" alt="Easy Cleaner Brush">
                    </div>

                    <div class="card-content">
                        <h5 class="card-title"><?=$product['product']?></h5>

                        <article class="card-body">
                            <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]"><?=$product['descrp']?></p>
                            <p class="text-sm leading-[-0.07px]">
                                Kes <?=$product['price']?>
                                <span class="text-red text-[0.8125rem]">
                                    <span class="line-through">sh.3,499</span>
                                    <span class="font-bold">(40%off)</span>
                                </span>
                            </p>
                            <p class="text-gray text-sm">offer price sh.1,750</p>
                        </article>
                    </div>
                </a>
            <?php } ?>

                <!-- <div class="card-wrapper">
                    <div class="card-media">
                        <img src="public/img/water-pump-SM100A-150A.jpg" class="card-image" alt="Easy Cleaner Brush">
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
                </div> -->

            </div>
        </div>
    </section>
    <!-- end featured products section -->

    <!-- <section class="py-8 bg-white"></section> -->

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>