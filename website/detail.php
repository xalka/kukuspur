<?php

    require_once __dir__.'/core/config.php';
    require_once __dir__.'/core/funcs.php';
    require_once __dir__.'/core/mysql.php';
    require_once __dir__.'/core/procs.php';

    $id = validInt($_GET['id']);

    if(!Authorization()){
        header('Location: /post?id='.$id);
        exit;        
    }

    $dbData = [ 
        'action' => 4, 
        'articleId' => $id, 
        // 'topstory' => 1, 
        'statusId' => 3, 
        // 'published' => 1, 
        'limit' => 1 
    ];
    
    $data['article'] = Proc(Article($dbData));

    if(isset($data['article'][0][0]['articleId'])) $data['article'] = $data['article'][0][0];

    else {
        header('Location: /404');
        exit;
    }

    $dbData = [ 
        'action' => 3, 
        'articleId' => $id, 
        'categoryId' => $data['article']['categoryId'], 
        'limit' => 7
    ];
    $data['recent'] = Proc(Article($dbData))[0];

    $dbData = [ 'action' => 1 ];
    $categories = Proc(Article($dbData))[0];    

    if(!ReqAjax()) require_once __dir__.'/inc/header.php';

?>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left: Post Detail -->
    <article class="lg:col-span-2 bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold text-gray-600 mb-2"><?=$data['article']['title']?></h1>
        <p class="text-sm text-gray-500 mb-4 capitalize">
            By <span class="font-medium"><?=$data['article']['fname']?></span> | <?=datetime('d M, y',$data['article']['publishedAt'])?>
        </p>
        <img src="/images/full/<?=$data['article']['img']?>" alt="<?=$data['article']['title']?>" class="w-full rounded mb-6">

        <div class="prose max-w-none">
            <?=htmlspecialchars_decode($data['article']['content'])?>
        </div>
    </article>

    <!-- Right: Related Posts -->
    <aside class="space-y-4">

        <h2 class="text-xl font-semibold border-b pb-2 mb-4 text-gray-600">Related Posts</h2>

        <?php foreach ($data['recent'] as $post): ?>
        <a href="/<?=Authorization()?'detail':'post'?>?id=<?=$post['articleId']?>" class="bg-white p-3 mb-3 flex items-center space-x-4 border-b border-gray-300 shadow-lg">
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