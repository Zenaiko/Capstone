<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="../css/product-add.css">
</head>
<body>
    <?php require_once('../utilities/initialize.php');
            require_once('../db_api/db_add_item.php');
            $item = $_GET["item"]??null;
    ?>

    <form action="../db_api/db_add_item.php<?="?item=".$item??null?>" method="post" enctype="multipart/form-data">
        <div class="form-container">
            <!-- Product Name Section -->
            <div class="section" id="product-name-section">
                <label for="product-name">Product Name</label>
                <span id="product-name-counter">0/100</span>
                <input type="text" id="product-name" name="product_name" placeholder="Product name" maxlength="100" oninput="updateCounter('product-name', 'product-name-counter', 100)" value="<?=$item_info->get_name()??null?>">
            </div>
            <!-- Product Description Section -->
            <div class="section" id="description-section">
                <label for="description">Product Description</label>
                <span id="description-counter">0/500</span>
                <textarea id="description" placeholder="Product description" name="product_desc" maxlength="500" oninput="updateCounter('description', 'description-counter', 500)"><?=$item_info->get_desc()??null?></textarea>
            </div>
            <!-- Category Section -->
            <div class="section" id="category-section">
                <div id="toggle_splitter">
                    <div id="category">
                        <span>Category</span>
                        <p id="category_shown"><?=$item_info->get_category()??null?></p>
                    </div>
                    <i class="bi bi-chevron-right" id="categ_chev" data-bs-toggle="collapse" data-bs-target="#div_collapse" aria-expanded="false" aria-controls="div_collapse"></i>
                </div>
                <hr>
                <div class="collapse" id="div_collapse" data-bs-toggle="collapse" data-bs-target="#div_collapse" aria-expanded="false" aria-controls="div_collapse" >
                    <?php 
                        foreach ($category_array as $category){?>
                         <div class="category" >
                            <input type="radio" class="radio_ary" name="category" value="<?=$category['category']?>" id="<?=$category['category']?>" <?=($item_info->get_category() === $category['category'])?"Checked":"" ?>>
                            <label for="<?=$category['category']?>"><?=ucfirst($category['category'])?></label>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <!-- Price Section -->
            <div class="section" id="price-section">
                <span>Price</span>
                <div class="price-input">
                    <input type="text" id="price" name="price" placeholder="0.00" value="<?=($item_info->get_min_price().(($item_info->get_max_price()!==$item_info->get_min_price())?"-".$item_info->get_max_price():null))??null?>">
                </div>
            </div>
            <!-- Stock Section -->
            <div class="section" id="stock-section">
                <span>Stock</span>
                <input type="text" id="stock" name="stock" placeholder="Set" value="<?=$item_info->get_item_stock()?>">
            </div>  
       
            <div class="section" id="stock-section">
                <div id="variant_splitter">
                    <span>Variant</span>
                    <i class="bi bi-plus-lg"  id="add_variant_btn" data-bs-toggle="offcanvas" data-bs-target="#variant_form" aria-controls="variant_form"></i>
                </div>

                <!-- Variants -->
                <div class="added_varaint_container">
                    <div class="added_variant_contents" id="added_variant_contents">
                            
                    <!-- Structure made by JS DOM or for edit -->
                        <?php if($item_info->get_variant_array()){
                            foreach($item_info->get_variant_array() as $variant_info){ ?>
        
                            <div class="added_varaint">
                                <div class="var_contents">
                                    <img src="<?=$variant_info["item_img"]?>" alt="" class="var_img">
                                    <div class="added_var_info">
                                        <input type="text"  readonly name="variant_name[<?=$variant_info["variation_name"]?>]" value="<?=$variant_info["variation_name"]?>">
                                        <input type="text"  readonly name="variant_name[<?=$variant_info["variation_name"]?>][stock]" value="<?=$variant_info["variation_stock"]?>" >
                                        <input type="text"  readonly name="variant_name[<?=$variant_info["variation_name"]?>][price]" value="<?=$variant_info["variation_price"]?>" >
                                        <input type="file"  readonly name="variant_name[<?=$variant_info["variation_name"]?>][img]" value="<?=$variant_info["item_img"]?>" >
                                        <input type="text"  readonly hidden name="variant_name[<?=$variant_info["variation_name"]?>][id]" value="<?=$variant_info["variation_id"]?>">
                                    </div>
                                </div>
                            </div>

                        <?php }} ?>
                    

                    </div>
                </div>
                
                <!-- Add Variants -->
                <div class="offcanvas offcanvas-bottom" id="variant_form" data-bs-scroll="false" tabindex="-1" aria-labelledby="offcanvasBottomLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title vairant_title" id="vairant_title"></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body large">
                    <div class="variant_type_container">
                        <div class="variant">
                            <div class="variant_info_container">
                                <div class="variant_type_info">
                                    <label for="">Name</label>
                                    <input type="text" name="variant_form_type" id="variant_form_type">
                                </div>
                                <div class="variant_type_info">
                                    <label for="">Price</label>
                                    <input type="text" name="variant_form_price" id="variant_form_price">
                                </div>
                                <div class="variant_type_info">
                                    <label for="">Stock</label>
                                    <input type="text" name="variant_form_stock" id="variant_form_stock">
                                </div>
                            </div>
                            
                        </div>
                            <button type="button" data-bs-dismiss="offcanvas" aria-label="Close" id="add_variant_type">Add</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Upload Image Section -->
            <div class="section" id="upload-image-section">
                <span>Upload Images</span>
                <input type="file" id="upload-images" name="add_item_img[]"  multiple onchange="previewImages(event)">
                <div id="image-preview-container"></div>
            </div>

            <div class="buttons">
                <input type="submit" name="item_interaction" id="" value="<?=(is_null($item))?"Add Item":"Edit"?>">
            </div>
        </div>
    </form>
    <script src="../js/seller_prod.js"></script>
</body>
</html>
