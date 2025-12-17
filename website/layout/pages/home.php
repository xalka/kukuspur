<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <div class="hero-banner bg-cover bg-no-repeat"></div>

    <!-- start featured products section -->
    <section class="featured-products bg-deep-gray pt-[2.375rem] lg:py-[3.375rem]">
        <div class="container">
            <div class="grid place-items-center mb-[3.0625rem]">
                <h1 class="tracking-[-2.4px] text-black text-3xl md:text-[2.5rem]">
                <span class="font-bold">Featured</span>
                    Products
                </h1>
                <p class="text-lg md:text-xl font-semibold tracking-[-1.2px] text-[#737373]">Special pick for you</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:grid-cols-4 xl:grid-cols-5 lg:gap-[1.0625rem]">
            <?php foreach ($data['products']['featured'] as $product) { ?>
                
                <a class="card-wrapper" href="/product?id=<?=$product['productId']?>">
                    <div class="card-media">
                        <img src="/public/img/uploads/<?=$product['img']?>" class="card-image" alt="<?=$product['product']?>">
                    </div>

                    <div class="card-content">
                        <h5 class="card-title"><?=$product['product']?></h5>
                        <article class="card-body">
                            <!-- <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]"><?=$product['product']?></p> -->
                            <p class="text-sm leading-[-0.07px]">
                                <?=$product['price']?>
                                <span class="text-red text-[0.8125rem]">
                                <span class="line-through">Kes <?=$product['price']?></span>
                                <span class="font-bold">(<?=$product['discount']?> %off)</span>
                                </span>
                            </p>
                            <p class="text-gray text-sm">offer price Kes <?=$product['price']?></p>
                        </article>
                    </div>
                </a>

            <?php } ?>

            </div>
        </div>
    </section>
    <!-- end featured products section -->


  <section class="bg-white py-[2.1875rem]">
    <!-- start advertisement section -->
    <div class="container overflow-hidden">
      <div class="relative w-full max-h-[20rem]">
        <img src="public/img/TractorAd.jpg" class="w-full h-full object-cover" alt="TractorAd Picture">
      </div>
    </div>
    <!-- end advertisement section -->

    <!-- start top-best -->
    <div class="container mt-[3.0625rem]">
      <div class="flex items-center justify-between w-full">
        <h2 class="text-xl md:text-[2rem] tracking-[0.8px] font-bold">Top Best</h2>
        <h3 class="text-standard-wireframe text-xl tracking-[-1.2px]">More +</h3>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:grid-cols-4 xl:grid-cols-5 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border">

      <?php foreach ($data['products']['best'] as $product) { ?>

        <a class="card-wrapper" href="/product?id=<?=$product['productId']?>">
          <div class="card-media">
            <img src="/public/img/uploads/<?=$product['img']?>" class="card-image" alt="<?=$product['product']?>">
          </div>

          <div class="card-content">
            <h5 class="card-title"><?=$product['product']?></h5>

            <article class="card-body">
              <!-- <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]"><?=$product['product']?></p> -->
              <p class="text-sm leading-[-0.07px]">
                Kes <?=$product['price']?>
                <span class="text-red text-[0.8125rem]">
                  <span class="line-through">Kes <?=$product['price']?></span>
                  <span class="font-bold">(<?=$product['discount']?> %off)</span>
                </span>
              </p>
              <p class="text-gray text-sm">offer price Kes <?=$product['price']?></p>
            </article>

          </div>
      </a>

      <?php } ?>

      </div>
    </div>
    <!-- end top-best -->
  </section>


  <!-- start farm-material section -->
  <section class="bg-white pb-[2.1875rem]">
    <div class="container">
      <div class="flex items-center justify-between w-full">
        <h2 class="text-xl md:text-[2rem] tracking-[0.8px] font-bold">Farm Material</h2>
        <h3 class="text-standard-wireframe text-xl tracking-[-1.2px]">More +</h3>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:grid-cols-4 xl:grid-cols-5 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border">
      <?php foreach ($data['products']['farm'] as $product) { ?>
        <a class="card-wrapper" href="/product?id=<?=$product['productId']?>">
          <div class="card-media">
            <img src="/public/img/uploads/<?=$product['img']?>" class="card-image" alt="<?=$product['product']?>">
          </div>

          <div class="card-content">
          <h5 class="card-title"><?=$product['product']?></h5>

            <article class="card-body">
              <!-- <p class="tracking-[-0.075px] text-[0.9375rem] leading-[129%]">Panelled Low-Top lace Up Sneakers</p> -->
              <p class="text-sm leading-[-0.07px]">
                Kes <?=$product['price']?>
                <span class="text-red text-[0.8125rem]">
                  <span class="line-through">Kes <?=$product['price']?></span>
                  <span class="font-bold">(<?=$product['discount']?> %off)</span>
                </span>
              </p>
              <p class="text-gray text-sm">offer price Kes <?=$product['price']?></p>
            </article>
          </div>
        </a>
      <?php } ?>
      </div>
    </div>
  </section>
  <!-- end farm-material section -->

  <!-- start feature section -->
  <section class="py-4 bg-white pb-16">
    <div class="px-4 container max-w-7xl sm:px-6 lg:px-8">

      <div class="grid place-items-center mb-[3.0625rem]">
        <h1 class="tracking-[-2.4px] text-black text-[2.5rem]">
          <span class="font-bold">Our</span>
          Values
        </h1>
        <p class="text-xl font-semibold tracking-[-1.2px] text-[#737373]">Special pick for you</p>
      </div>

      <div class="grid grid-cols-1 text-center sm:grid-cols-2 gap-y-8 lg:grid-cols-4 xl:grid-cols-5 sm:gap-12">
        <div>
          <div class="flex items-center justify-center size-20 mx-auto bg-blue rounded-full">
            <svg class="text-white size-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
            </svg>
          </div>
          <h3 class="mt-8 text-lg font-semibold text-black">Secured Payments</h3>
          <p class="mt-4 text-sm text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet
            sint. Velit officia consequat duis enim velit mollit.</p>
        </div>

        <div>
          <div class="flex items-center justify-center w-20 h-20 mx-auto bg-orange-100 rounded-full">
            <svg class="text-orange-600 w-9 h-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h3 class="mt-8 text-lg font-semibold text-black">Fast & Easy to Load</h3>
          <p class="mt-4 text-sm text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet
            sint. Velit officia consequat duis enim velit mollit.</p>
        </div>

        <div>
          <div class="flex items-center justify-center w-20 h-20 mx-auto bg-green-100 rounded-full">
            <svg class="text-green-600 w-9 h-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
          </div>
          <h3 class="mt-8 text-lg font-semibold text-black">Light & Dark Version</h3>
          <p class="mt-4 text-sm text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet
            sint. Velit officia consequat duis enim velit mollit.</p>
        </div>

        <div>
          <div class="flex items-center justify-center size-20 mx-auto bg-sky-400 rounded-full">
            <svg class="text-white w-9 h-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
          </div>
          <h3 class="mt-8 text-lg font-semibold text-black">Filter Blocks</h3>
          <p class="mt-4 text-sm text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet
            sint. Velit officia consequat duis enim velit mollit.</p>
        </div>
        <div>
          <div class="flex items-center justify-center size-20 mx-auto bg-red rounded-full">
            <svg class="text-white w-9 h-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
          </div>
          <h3 class="mt-8 text-lg font-semibold text-black">Filter Blocks</h3>
          <p class="mt-4 text-sm text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet
            sint. Velit officia consequat duis enim velit mollit.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- end feature section -->
 

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>