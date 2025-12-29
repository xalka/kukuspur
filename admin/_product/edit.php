<?php 
    
    if(ReqGet()){ 
        
        $dbData = [ 
            'action' => 4, 
            'statusId' => 1, 
            'productId' => validInt($_GET['id'])
        ];
        $data['product'] = Proc(Product($dbData));

        if ( !isset($data['product'][0][0]['productId']) ) {
            header('Location: /404');
            exit;
        }

        $data['product'] = $data['product'][0][0];

        $dbData = [
            'action' => 1
        ];
        $data['categories'] = Proc(product($dbData))[0];        
        
?>

    <form action="products?action=edit&id=<?=$data['product']['productId']?>" method="POST" enctype="multipart/form-data">

        <div class="grid grid-cols-1 md:grid-cols-[7fr_3fr] gap-6">

            <!-- Left Column -->
            <div>
                <label>Title</label>
                <input type="text" name="title" class="mb-4" value="<?=$data['product']['title']?>" required/>

                <label>Subtitle</label>
                <input type="text" name="subtitle" class="mb-4" value="<?=$data['product']['subtitle']?>" required/>

                <label>Content</label>
                <div id="editor" name="content" rows="10"><?=htmlspecialchars_decode($data['product']['content'])?></div>
                <textarea name="content" class="hidden" required></textarea>
                
            </div>

            <!-- Right Column -->
            <div>
                <label>Category</label>
                <select name="categoryId">
                <?php foreach ($data['categories'] as $key => $value) { ?>
                    <option <?php if($value['categoryId'] == $data['product']['categoryId']){ ?> selected <?php } ?> value="<?=$value['categoryId']?>"><?=$value['title']?></option>
                <?php } ?>
                </select>

                <label>Tags</label>
                <input type="text" name="tags" class="mb-4" placeholder="e.g. tech, innovation" value="<?=$data['product']['tags']?>"/>

                <label>Publish Date & Time</label>
                <input type="text" name="publishedAt" class="datetimepicker" value="<?=$data['product']['publishedAt']?>">

                <label>Featured Image</label>

                <input type="file" name="image" accept="image/*" class="hidden" id="featured_image"/>
                <label for="featured_image" class="cursor-pointer">
                    <img src="/public/images/thumb/<?=$data['product']['img']?>" class="w-full featured_image">
                </label>

                <label class="flex items-center space-x-2 cursor-pointer text-2xl mt-4">
                    <input type="checkbox" class="accent-black hover:accent-green-500 w-full !w-auto" name="topproduct" <?php if($data['product']['topproduct'] == 1){ ?> checked <?php } ?> />
                    <span>Top story</span>
                </label>


            </div>
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <input type="hidden" name="statusId" value="<?=$data['product']['statusId']?>">
            <input type="hidden" name="productId" value="<?=$data['product']['productId']?>">

        </div>

        <!-- Actions -->
        <div class="flex justify-end mt-6 space-x-4">
            <button type="submit" class="btn-draft" onclick="babu.submitstatus(event,1)">
                Save as Draft
            </button>
            <button type="submit" class="btn-publish" onclick="babu.submitstatus(event,3)">
                Save & Publish
            </button>
        </div>

    </form>

<?php

} elseif(ReqPost()) { 
        
    csrfToken();
    
    if($_FILES['image']['size'] > 0){
        $image = uploadImg($_FILES,$_POST['title']);
    }
    
    // save into db
    $dbData = [
        'action' => 5,
        'productId' => validInt($_POST['productId']),
        'title' => htmlspecialchars($_POST['title'],ENT_QUOTES,'UTF-8'),
        'subtitle' => htmlspecialchars($_POST['subtitle'],ENT_QUOTES,'UTF-8'),
        'content' => htmlspecialchars($_POST['content']),
        'categoryId' => $_POST['categoryId'],
        'tags' => htmlspecialchars($_POST['tags'],ENT_QUOTES,'UTF-8'),
        'publishedAt' => $_POST['publishedAt'],
        'statusId' => validInt($_POST['statusId']),
        'published' => '0',
        'topproduct' => isset($_POST['topproduct']) ? 1 : 0,
        // 'authorId' => base64_decode($_SESSION[SESSION_KEY]['authorId'])
    ];

    if(isset($image)){
        $dbData['image'] = $image;
    }
    
    $product = Proc(product($dbData));

    if(isset($product[0][0]['updated'])){
        // remove the old images
        if(isset($image)){
            $thumb = IMAGES_DIR.'thumb/'.$product[0][0]['oldImg'];
            if (file_exists($thumb)) unlink($thumb);
            $full = IMAGES_DIR.'full/'.$product[0][0]['oldImg'];
            if (file_exists($full)) unlink($full);
        }

        exit(print_j([
            'status' => 200,
            'url' => '/products',
            'message' => 'product updated successfully'
        ]));

    } else {
        exit(print_j([
            'status' => 400,
            'message' => 'Failed to update the product'
        ]));        
    }
    
}

?> 
