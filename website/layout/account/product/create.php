<?php if(!ReqAjax()) require BASE_DIR.'/inc/header.php'; ?>

    <section class="content bg-white pt-4 mb-6">
        <div class="container flex lg:flex-row flex-col">

            <?php require __dir__.'/../sidebar.php'; ?>


            <!-- start right section -->
            <section class="w-full pb-4 lg:pt-4 lg:pl-[1.688rem]">

                <h2 class="text-xl md:text-[1.5rem] p-0 m-0">Product</h2>

                <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-[1.0625rem] pb-[1.8125rem] pt-5 border-b border-b-deep-gray-border"> -->
                <div class="mt-2 text-start">
                    <div class="min-h-screen bg-gray-100 mt-6 font-sans">
                        <!-- <h1 class="text-2xl font-bold text-vet-black mb-6">Welcome back, Jane!</h1> -->

                        <div class="bg-white rounded-xl px-4 pb-6 shadow-md">

                            <!-- <h3 class="text-xl font-bold mb-4 text-vet-black">Recent Orders</h3> -->

                            <form method="POST" action="/account?view=product&action=create" enctype="multipart/form-data" class="space-y-4">
    
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    
                                    <div class="space-y-4">

                                        <div>
                                            <label>Product name <span class="text-red">*</span></label>
                                            <input type="text" name="product" placeholder="Product name" class="mt-1 input-control"/>
                                        </div>
                                        
                                        <div>
                                            <label>Description <span class="text-red">*</span></label>
                                            <textarea rows="4" class="input-control" name="descrp"></textarea>
                                            <p class="text-right italic mt-1 text-xsm text-quick-gray">Character limit: 10/200</p>
                                        </div>

                                        <!-- Image Upload -->
                                        <div>
                                            <label class="block">Product Images</label>
                                            <!-- class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600">
                                                        <label class="relative cursor-pointer rounded-md bg-white font-medium text-blue-600 hover:text-blue-500">
                                                            <span>Upload new images</span>
                                                            <input type="file" class="sr-only" multiple accept="image/*">
                                                        </label>
                                                        <p class="pl-1">or drag and drop</p>
                                                    </div>
                                                    <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
                                                </div>
                                            </div-->

                                            <div class="flex flex-col items-center justify-center border-2 border-dashed border-blue rounded-lg cursor-pointer hover:bg-gray-100">
                                                <label for="product-img" class="flex flex-col items-center space-y-2 cursor-pointer w-full p-4">
                                                    <!-- Upload Icon -->
                                                    <svg class="w-12 h-12 text-gray-500 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M16 12l-4-4m0 0l-4 4m4-4v12"></path>
                                                    </svg>
                                                    <span class="text-gray-600 font-medium">Click to Upload</span>
                                                </label>
                                                <!-- Hidden File Input -->
                                                <!-- <input id="product-img" type="file" name="imgs" accept=".png,.jpg" class="hidden"> -->
                                                <input id="product-img" type="file" name="imgs[]" accept=".png,.jpg,.jpeg" class="hidden" multiple>
                                            </div>
                                            
                                            <!-- Current Images -->
                                            <div class="mt-4 grid grid-cols-4 gap-2 preview-images"></div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="space-y-4">
                                        <!-- Pricing -->
                                        <div class="grid grid-cols-3 gap-4">
                                            <div>
                                                <label>Price <span class="text-red">*</span></label>
                                                <input type="text" name="price" placeholder="Price" class="mt-1 input-control">
                                            </div>

                                            <div>
                                                <label>Discount</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="relative group">
                                                        <input type="text" class="input-control" name="discount" placeholder="Discount">
                                                        <div class="absolute inset-y-0 right-3 flex items-center">%</div>
                                                    </div>                                
                                                </div>
                                            </div>

                                            <div>
                                                <label>Tax</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="relative group">
                                                        <input type="text" class="input-control" name="tax" placeholder="Tax">
                                                        <div class="absolute inset-y-0 right-3 flex items-center">%</div>
                                                    </div>                                
                                                </div>
                                            </div>

                                        </div>

                                        <div class="grid grid-cols-2 gap-4">

                                            <!-- Stock Management -->
                                            <div>
                                                <label>Stock Quantity <i class="text-red">*</i></label>
                                                <input type="text" name="stock" placeholder="Stock Quality" class="mt-1 input-control">
                                            </div>

                                            <!-- Product Status -->
                                            <div>
                                                <label>Status <i class="text-red">*</i></label>
                                                <div class="mt-1">
                                                    <select name="statusId" class="input-control">
                                                        <option value="1">Active</option>
                                                        <option value="0">In-active</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="grid grid-cols-2 gap-4">

                                            <!-- Stock Management -->
                                            <div>
                                                <label>SKU <i class="text-red">*</i></label>
                                                <input type="text" name="sku" class="mt-1 input-control">
                                                <!-- <input type="text" name="stock" placeholder="Stock Quality" class="mt-1 input-control"> -->
                                            </div>

                                            <!-- Product Status -->
                                            <div>
                                                <label>Category <i class="text-red">*</i></label>
                                                <div class="mt-1">
                                                    <select name="categoryId" class="input-control">
                                                    <?php foreach ($data['categories'] as $category) {
                                                        echo '<option value="'.$category['categoryId'].'">'.$category['category'].'</option>';
                                                    } ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Advanced Options -->
                                        <div class="pt-4 border-t border-light-gray-border">
                                            <div class="text-sm font-medium text-gray-900">Advanced Options</div>
                                            <div class="mt-2 space-y-2">
                                                <div>
                                                    <label class="block text-sm text-gray-700">SEO Title</label>
                                                    <textarea rows="4" name="seo_title" class="input-control mt-1"></textarea>
                                                </div>
                                                <div>
                                                    <label class="block text-sm text-gray-700">Meta Description</label>
                                                    <textarea rows="4" name="meta_descrp" class="input-control mt-1"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="pt-6 border-t border-light-gray-border">
                                    <div class="flex justify-end gap-3">
                                        <!-- <button type="button" class="danger-button">
                                            Cancel
                                        </button> -->
                                        <button type="submit" class="primary-button">
                                            Create
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
                
            </section>
            
        </div>
    </section>

<?php if(!ReqAjax()) require BASE_DIR.'/inc/footer.php'; ?>