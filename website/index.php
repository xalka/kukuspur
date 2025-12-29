<?php

    require_once __dir__.'/core/config.php';
    require_once __dir__.'/core/funcs.php';
    require_once __dir__.'/core/mysql.php';
    require_once __dir__.'/core/procs.php';

    $dbData = [ 
        'action' => 3, 
        // 'topproduct' => 1, 
        'statusId' => 3,
        'limit' => 1 
    ];
    $data['topproduct'] = Proc(Product($dbData))[0][0];

    $dbData = [ 
        'action' => 3, 
        // 'topproduct' => 0, 
        'statusId' => 3, 
        'limit' => 3 
    ];
    $data['recent'] = Proc(Product($dbData))[0];

    $dbData = [ 'action' => 1 ];
    $categories = Proc(Product($dbData))[0];


    if(!ReqAjax()) require_once __dir__.'/inc/header.php';

?>

    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Top Story -->
        <div class="md:col-span-2 bg-white shadow rounded-lg p-6 group hover:cursor-pointer transition-all duration-300">
            <a href="/<?=Authorization()?'detail':'post'?>?id=<?=$data['topproduct']['productId']?>">
                <img src="/images/full/<?=$data['topproduct']['img']?>" alt="<?=$data['topproduct']['title']?>" class="w-full h-100 object-cover rounded mb-4 transform transition-transform duration-300 ease-in-out group-hover:scale-105">
                <h3 class="text-title"><?=$data['topproduct']['title']?></h3>
                <p class="text-published">Published on: <?=$data['topproduct']['publishedAt']?></p>
                <p class="text-sub-title"><?=$data['topproduct']['subtitle']?></p>
                <span class="read-more group-hover:underline">
                    Read Full Story 
                </span>
            </a>
        </div>

        <!-- Recent Posts -->
        <div class="space-y-4">
            <!-- <h2 class="text-xl font-bold text-gray-800 mb-2">Recent Posts</h2> -->

            <?php foreach ($data['recent'] as $post): ?>
            
            <div class="bg-white shadow-lg rounded-lg overflow-hidden group hover:cursor-pointer transition-all duration-300">
                <a href="/<?=Authorization()?'detail':'post'?>?id=<?=$post['productId']?>">
                    <img src="/images/thumb/<?=$post['img']?>" alt="<?=$post['title']?>" class="w-full h-30 object-cover rounded transform transition-transform duration-300 ease-in-out group-hover:scale-105">
                    <div class="p-4">
                        <h4 class="font-semibold text-gray-900"><?=$post['title']?></h4>
                        <p class="text-sm text-gray-500 mt-1">Published: <?=$post['publishedAt']?></p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>

        </div>

    </div>


    <?php 

        foreach ($categories as $category) {
            $dbData = [ 
                'action' => 3, 
                'categoryId' => $category['categoryId'], 
                'statusId' => 3, 
                //'topproduct' => null, 
                'limit' => 4 
            ];
            $products = Proc(Product($dbData))[0];
            
    
            if(!empty($products)) { 
            
    ?>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 capitalize"><?=$category['title']?></h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-6 border-b border-gray-300">

            <!-- Category Card 1 -->
            <?php foreach ($products as $post) { ?>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden group hover:cursor-pointer transition-all duration-300">
                <a href="/<?=Authorization()?'detail':'post'?>?id=<?=$post['productId']?>" class="block hover:opacity-90">
                    <img src="/images/thumb/<?=$post['img']?>" alt="<?=$post['title']?>" class="w-full h-40 object-cover rounded transform transition-transform duration-300 ease-in-out group-hover:scale-105">
                    <div class="p-4">
                    <span class="text-xs text-<?=$post['title']?> uppercase font-bold"><?=$post['category']?></span>
                    <h3 class="mt-2 text-md font-semibold text-gray-900"><?=$post['title']?></h3>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>
    
    </div>

    <?php  
            }
        }
        
    if(!ReqAjax()) require_once __dir__.'/inc/footer.php'; 
    
?>