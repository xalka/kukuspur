<?php

    require_once __dir__.'/core/config.php';
    require_once __dir__.'/core/funcs.php';
    require_once __dir__.'/core/mysql.php';
    require_once __dir__.'/core/procs.php';

    $id = validInt($_GET['id']);

    $dbData = [ 
        'action' => 4, 
        'productId' => $id, 
        // 'topstory' => 1, 
        'statusId' => 3, 
        // 'published' => 1, 
        'limit' => 1 
    ];
    
    $data['product'] = Proc(Product($dbData));

    if(isset($data['product'][0][0]['productId'])) $data['product'] = $data['product'][0][0];

    else {
        header('Location: /404');
        exit;
    }

    $dbData = [ 
        'action' => 3, 
        'productId' => $id, 
        'categoryId' => $data['product']['categoryId'], 
        'limit' => 7
    ];
    $data['recent'] = Proc(product($dbData))[0];

    $dbData = [ 'action' => 1 ];
    $categories = Proc(product($dbData))[0];    

    if(!ReqAjax()) require_once __dir__.'/inc/header.php';

?>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left: Post Detail -->
    <product class="lg:col-span-2 bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold text-gray-600 mb-2"><?=$data['product']['title']?></h1>
        <p class="text-sm text-gray-500 mb-4 capitalize">
            By <span class="font-medium"><?=$data['product']['fname']?></span> | <?=datetime('d M, y',$data['product']['publishedAt'])?>
        </p>
        <img src="/images/full/<?=$data['product']['img']?>" alt="<?=$data['product']['title']?>" class="w-full rounded mb-6">

        <div class="prose max-w-none mb-4">
            <?=htmlspecialchars_decode($data['product']['subtitle'])?>
        </div>

        <div class="prose max-w-none">
            <div class="relative overflow-hidden text-gray-800 leading-relaxed">
                <div class="[mask-image:linear-gradient(to_bottom,black_1%,transparent)]">            
                    <?=htmlspecialchars_decode(substr($data['product']['content'],0,400))?>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center my-6">
            <button class="btn btn-create" data-modal-href="/subscribe">
                Subscribe for more
            </button>
        </div>

    </product>

    <!-- Right: Related Posts -->
    <aside class="space-y-4">

        <h2 class="text-xl font-semibold border-b pb-2 mb-4 text-gray-600">Related Posts</h2>

        <?php foreach ($data['recent'] as $post): ?>
        <a href="/<?=Authorization()?'detail':'post'?>?id=<?=$post['productId']?>" class="bg-white p-3 mb-3 flex items-center space-x-4 border-b border-gray-300 shadow-lg">
            <img src="/images/thumb/<?=$post['img']?>" alt="<?=$post['title']?>" class="w-20 h-16 object-cover rounded">
            <div>
                <h3 class="text-sm font-semibold text-gray-700"><?=$post['title']?></h3>
                <p class="text-xs text-gray-500"><?=datetime('d M, y',$post['publishedAt'])?></p>
            </div>
        </a>
        <?php endforeach; ?>
        
    </aside>

</div>

<?php if(!ReqAjax()) require_once __dir__.'/inc/footer.php'; ?>