<?php 
    
    if(ReqGet()){ 
        
        $dbData = [ 
            'action' => 4, 
            'productId' => validInt($_GET['id'])
        ];
        $data['product'] = Proc(Product($dbData));

        if ( !isset($data['product'][0][0]['productId']) ) {
            header('Location: /404');
            exit;
        }

        $data['product'] = $data['product'][0][0];

?>

    <div class="form-product-admin">

        <div class="grid grid-cols-1 md:grid-cols-[7fr_3fr] gap-6">

            <!-- Left Column -->
            <div>
                <label>Title</label>
                <input type="text" name="title" value="<?=$data['product']['title']?>" required/>

                <label>Subtitle</label>
                <input type="text" name="subtitle" value="<?=$data['product']['subtitle']?>" required/>

                <label>Content</label>
                <div class="border-1 border-gray-300 rounded px-4 py-2">
                    <?=htmlspecialchars_decode($data['product']['content'])?>
                </div>
                
            </div>

            <!-- Right Column -->
            <div>
                <label>Category</label>
                <input class="capitalize" type="text" value="<?=$data['product']['category']?>">

                <label>Tags</label>
                <input type="text" name="tags" placeholder="e.g. tech, innovation" value="<?=$data['product']['tags']?>"/>

                <label>Publish Date & Time</label>
                <input type="text" name="publishedAt" value="<?=$data['product']['publishedAt']?>">

                <label>Featured Image</label>
                <img src="/public/images/thumb/<?=$data['product']['img']?>">

                <label class="flex items-center space-x-2 text-2xl mt-4 cursor-pointer">
                    <input type="checkbox" class="accent-black hover:accent-green-500 w-full !w-auto" name="topstory" <?php if($data['product']['topstory'] == 1){ ?> checked <?php } ?> />
                    <span>Top story</span>
                </label>

                <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
                <input type="hidden" name="productId" value="<?=$data['product']['productId']?>">

            </div>

        </div>

    </div>




<?php

} elseif(ReqPost()) { 
    
    csrfToken();
    
    // save into db
    $dbData = [
        'action' => 6,
        'productId' => validInt($_POST['productId']),
        'statusId' => validInt($_POST['status']),
        'topproduct' => isset($_POST['topproduct']) && $_POST['topproduct']===true ? 1 : 0,
        'userId' => base64_decode($_SESSION[SESSION_KEY]['userId'])
    ];

    $product = Proc(Product($dbData));

    if(isset($product[0][0]['updated'])){
        exit(print_j([
            'status' => 200,
            'url' => '/products',
            'message' => 'product updated successfully'
        ]));
    } else {
        exit(print_j([
            'status' => 400,
            'message' => 'Failed to update product'
        ]));        
    }
    
}

?> 
