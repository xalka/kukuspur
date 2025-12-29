<?php 

    if(!ReqAjax()) require __dir__.'/../inc/header.php';

    $dbData = [
        'action' => 3,
        'topstory' => null
        // 'authorId' => base64_decode($_SESSION[SESSION_KEY]['authorId'])
    ];
    $products = Proc(Product($dbData))[0];   
    
?>
    <header>
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Products
                <button class="btn btn-create" data-modal-href="/products?action=create" data-modal-title="create new product" data-modal-size="max-w-6xl" data-modal-h="h-screen">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </button>

            </h1>
        </div>
        <?php require __dir__.'/../inc/user-nav.php'; ?>
    </header>        

    <main>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <!-- <th>Author</th> -->
                    <!-- <th>Top Story</th> -->
                    <th>Category</th>
                    <th>Status</th>
                    <th>Published At</th>
                    <!-- <th>Approved</th> -->
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach ($products as $product) { ?>
                <tr class="group relative">
                    <td><?=substr($product['title'],0,50)?></td>
                    <!-- <td class="capitalize"><?//=$product['fname']?></td> -->
                    <!-- <td>
                        <label class="flex items-center space-x-2 cursor-pointer text-2xl mt-3 pointer-events-none">
                            <input type="checkbox" class="accent-black hover:accent-green-500 w-full !w-auto" <?php if($product['topproduct']){ ?> checked <?php } ?>/>
                        </label>
                    </td> -->
                    <td class="capitalize"><?=$product['category']?></td>
                    <td class="capitalize td-<?=$product['status']?>"><?=$product['status']?></td>
                    <td><?=datetime('H:i d M,y',$product['publishedAt'])?></td>
                    <td><?=datetime('H:i d M,y',$product['createdAt'])?></td>
                    <td>
                        <div class="flex space-x-2">
                            <button class="table-btn btn-view" data-modal-href="/products?action=detail&id=<?=$product['productId']?>" data-modal-title="View product" data-modal-size="max-w-6xl">
                                View
                            </button>
                            <button class="table-btn btn-edit" 
                                <?php if($product['active'] != '1'){ ?>data-modal-href="/products?action=edit&id=<?=$product['productId']?>" data-modal-title="Update product" data-modal-size="max-w-6xl" <?php } ?>>
                                Edit
                            </button>                            
                            <button class="table-btn btn-delete" data-modal-href="/products?action=delete&id=<?=$product['productId']?>" data-modal-title="Delete product" data-modal-size="max-w-6xl">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </main>


    <?php if(!ReqAjax()) require __dir__.'/../inc/footer.php'; ?>