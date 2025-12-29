<?php 
    
    if(ReqGet()){ 

        $dbData = [
            'action' => 1
        ];

        $categories = Proc(Product($dbData))[0];
        
?>

    <!-- Form -->
    <form action="/products?action=create" method="POST" enctype="multipart/form-data">

        <div class="grid grid-cols-1 md:grid-cols-[7fr_3fr] gap-6">

            <!-- Left Column -->
            <div>
                <label>Title</label>
                <input type="text" name="title" required/>

                <label>Subtitle</label>
                <input type="text" name="subtitle" required/>

                <label>Content</label>
                <div id="editor" name="content" rows="10"></div>
                <textarea name="content" class="hidden" required></textarea>
                
            </div>

            <!-- Right Column -->
            <div>
                <label>Category</label>
                <select name="categoryId">
                <?php foreach ($categories as $key => $value) { ?>
                    <option value="<?=$value['categoryId']?>"><?=$value['title']?></option>
                <?php } ?>
                </select>

                <label>Tags</label>
                <input type="text" name="tags" placeholder="e.g. tech, innovation"/>

                <label>Publish Date & Time</label>
                <input type="text" name="publishedAt" class="datetimepicker">
                

                <label>Featured Image</label>
                <label for="featured_image" class="cursor-pointer">
                    <div class="w-full max-w-sm mx-auto border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        Click to upload featured image
                    </div>
                </label>
                <input type="file" name="image" accept="image/*" class="hidden" id="featured_image"/>

                <label class="flex items-center space-x-2 cursor-pointer text-2xl">
                    <input type="checkbox" class="accent-black hover:accent-green-500 w-full !w-auto" name="topstory" />
                    <span>Top story</span>
                </label>

            </div>
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <input type="hidden" name="statusId" value="1">

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
        
        $image = uploadImg($_FILES,$_POST['title']);
        // print_r($image); exit;
        if(!is_string($image)){
            exit(print_j($image));
        }
        
        // save into db
        $dbData = [
            'action' => 2,
            'title' => htmlspecialchars($_POST['title'],ENT_QUOTES,'UTF-8'),
            'subtitle' => htmlspecialchars($_POST['subtitle'],ENT_QUOTES,'UTF-8'),
            'content' => htmlspecialchars($_POST['content']),
            'categoryId' => $_POST['categoryId'],
            'tags' => htmlspecialchars($_POST['tags'],ENT_QUOTES,'UTF-8'),
            'publishedAt' => $_POST['publishedAt'],
            'image' => $image,
            'statusId' => validInt($_POST['statusId']),
            'topstory' => isset($_POST['topstory']) ? 1 : 0,
            // 'authorId' => base64_decode($_SESSION[SESSION_KEY]['authorId'])
        ]; 
        
        $product = Proc(Product($dbData));

        if(isset($product[0][0]['created'])){
            exit(print_j([
                'status' => 200,
                'url' => '/products',
                'message' => 'product created successfully'
            ]));
        } else {
            exit(print_j([
                'status' => 400,
                'message' => 'Failed to save product'
            ]));        
        }
        
    }

?> 
