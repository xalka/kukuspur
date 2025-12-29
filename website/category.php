<?php

    require_once __dir__.'/core/config.php';
    require_once __dir__.'/core/funcs.php';
    require_once __dir__.'/core/mysql.php';
    require_once __dir__.'/core/procs.php';

    $id = validInt($_GET['id']);

    $dbData = [ 
        'action' => 3, 
        'categoryId' => $id, 
        // 'topproduct' => null, 
        'statusId' => 3, 
        // 'published' => 1, 
        'limit' => 20 
    ];

    $data['products'] = Proc(Product($dbData));

    if(!empty($data['products'][0])) $data['products'] = $data['products'][0];

    else {
        header('Location: /404');
        exit;
    }    

    $dbData = [ 'action' => 1 ];
    $categories = Proc(product($dbData))[0];     

    if(!ReqAjax()) require_once __dir__.'/inc/header.php';

?>

<div class="mt-6">
    <div class="max-w-7xl mx-auto px-4 py-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 capitalize"><?=$_GET['category']?></h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-6 border-b border-gray-300">

            <!-- Category Card 1 -->
            <?php 

            foreach ($data['products'] as $post):
                
            ?>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden group hover:cursor-pointer transition-all duration-300">
                <a href="/<?=Authorization()?'detail':'post'?>?id=<?=$post['productId']?>" class="block hover:opacity-90">
                    <img src="/images/thumb/<?=$post['img']?>" alt="<?=$post['title']?>" class="w-full h-40 object-cover rounded transform transition-transform duration-300 ease-in-out group-hover:scale-105">
                    <div class="p-4">
                    <span class="text-xs text-<?=$post['title']?> uppercase font-bold"><?=$post['category']?></span>
                    <h3 class="mt-2 text-md font-semibold text-gray-900"><?=$post['title']?></h3>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>

        </div>

    </div>
</div>



<!-- <div class="max-w-7xl mx-auto px-4 py-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Explore by Category</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-6 border-b border-gray-300">

        <?php 

        $data['categories'] = [
            [
                'id' => 1,
                'name' => 'Technology',
                'image' => 'ethiopia.png',
                'title' => 'AI: What\'s Next?',
                'published_at' => '2023-07-25',
                'category' => 'Technology'
            ],
            [
                'id' => 1,
                'name' => 'Business',
                'image' => 'ethiopia.png',
                'title' => 'Future of AI: What\'s Next?',
                'published_at' => '2023-07-25',
                'category' => 'Business'
            ],
            [
                'id' => 1,
                'name' => 'Science',
                'image' => 'ethiopia.png',
                'title' => 'Future of AI: What\'s Next?',
                'published_at' => '2023-07-25',
                'category' => 'Science'
            ],
            [
                'id' => 1,
                'name' => 'Health',
                'image' => 'ethiopia.png',
                'title' => 'Future of AI: What\'s Next?',
                'published_at' => '2023-07-25',
                'category' => 'Health'
            ],                                                            
        ];

        foreach ($data['categories'] as $post) {
            
        ?>

        <div class="bg-white rounded-lg shadow">
            <a href="/category/technology" class="block hover:opacity-90">
                <img src="/public/images/thumb/<?=$post['image']?>" alt="<?=$post['title']?>" class="w-full h-40 object-cover rounded-t-lg">
                <div class="p-4">
                <span class="text-xs text-<?=$post['title']?> uppercase font-bold"><?=$post['category']?></span>
                <h3 class="mt-2 text-md font-semibold text-gray-900"><?=$post['title']?></h3>
                </div>
            </a>
        </div>
        <?php } ?>

    </div>

</div> -->


<?php if(!ReqAjax()) require_once __dir__.'/inc/footer.php'; ?>