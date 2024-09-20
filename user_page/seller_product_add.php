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
            require_once('../db_api/db_get.php');
    ?>

    <form action="../db_api/db_add_item.php" method="post" enctype="multipart/form-data">
        <div class="form-container">
            <!-- Product Name Section -->
            <div class="section" id="product-name-section">
                <label for="product-name">Product Name</label>
                <span id="product-name-counter">0/100</span>
                <input type="text" id="product-name" name="product_name" placeholder="Product name" maxlength="100" oninput="updateCounter('product-name', 'product-name-counter', 100)">
            </div>
            <!-- Product Description Section -->
            <div class="section" id="description-section">
                <label for="description">Product Description</label>
                <span id="description-counter">0/500</span>
                <textarea id="description" placeholder="Product description" name="product_desc" maxlength="500" oninput="updateCounter('description', 'description-counter', 500)"></textarea>
            </div>
            <!-- Category Section -->
            <div class="section" id="category-section">
                <div id="toggle_splitter">
                    <div id="category">
                        <span>Category</span>
                        <p id="category_shown" ></p>
                    </div>
                    <i class="bi bi-chevron-right" id="categ_chev" data-bs-toggle="collapse" data-bs-target="#div_collapse" aria-expanded="false" aria-controls="div_collapse"></i>
                </div>
                <div class="collapse" id="div_collapse">
                    <hr>
                   
                    <?php 
                        foreach ($category_array as $category){?>
                         <div class="category">
                            <input type="radio" class="radio_ary" name="category"data-bs-toggle="collapse" data-bs-target="#div_collapse" aria-expanded="false" aria-controls="div_collapse" value="<?=$category['category']?>" id="<?=$category['category']?>">
                            <label for="<?=$category['category']?>"><?=ucfirst($category['category'])?></label>
                        </div>
                    <?php }
                    ?>

                    <!-- <div class="category">
                        <input type="radio" name="categ" id="categ_meat">
                        <label for="categ_meat">Meat</label>
                    </div>
                    <div class="category">
                        <input type="radio" name="categ" id="categ_fish">
                        <label for="categ_fish">Fish</label>
                    </div>
                    <div class="category">
                        <input type="radio" name="categ" id="categ_aaa">
                        <label for="categ_aaa">AAA</label>
                    </div>
                    <div class="category">
                        <input type="radio" name="categ" id="categ_other">
                        <label for="categ_other">Others</label>
                    </div>
                    <div class="category">
                        <input type="radio" name="categ" id="categ_ku">
                        <label for="categ_ku">Kitchenware and Utensils</label>
                    </div> -->
                </div>
            </div>
            <!-- Price Section -->
            <div class="section" id="price-section">
                <span>Price</span>
                <div class="price-input">
                    <input type="text" id="price" placeholder="0.00">
                </div>
            </div>
            <!-- Stock Section -->
            <div class="section" id="stock-section">
                <span>Stock</span>
                <input type="text" id="stock" placeholder="Set">
            </div>  
       
            <div class="section" id="stock-section">
                <div id="variant_splitter">
                    <span>Variant</span>
                    <i class="bi bi-plus-lg"  id="add_variant_btn" data-bs-toggle="offcanvas" data-bs-target="#variant_form" aria-controls="variant_form"></i>
                </div>

                <!-- Variants -->
                <div class="added_varaint_container">
                    <div class="added_variant_contents" id="added_variant_contents">
                        <!-- <div class="added_varaint">
                            <div class="var_header">
                                <input type="text" disabled readonly class="var_name" placeholder="Color">
                                <div class="var_buttons">
                                    <button class="var_button">Edit</button>
                                    <button class="var_button">Add</button>
                                </div>
                            </div>
                            <div class="var_contents">
                                <img src="../assets/tmp.png" alt="" class="var_img">
                                <div class="added_var_info">
                                    <input type="text" disabled readonly name="" id="" placeholder="Green">
                                    <input type="text"  disabled readonly name="" id="" placeholder="₱30">
                                    <input type="text" disabled readonly name="" id="" placeholder="24pcs">
                                </div>
                            </div>
                            <div class="var_contents">
                                <img src="../assets/tmp.png" alt="" class="var_img">
                                <div class="added_var_info">
                                    <input type="text" disabled readonly name="" id="" placeholder="Green">
                                    <input type="text"  disabled readonly name="" id="" placeholder="₱30">
                                    <input type="text" disabled readonly name="" id="" placeholder="24pcs">
                                </div>
                            </div>
                        </div>

                        <div class="added_varaint">
                            <div class="var_header">
                                <input type="text" disabled readonly class="var_name" placeholder="Color">
                                <div class="var_buttons">
                                    <button class="var_button">Edit</button>
                                    <button class="var_button">Add</button>
                                </div>
                            </div>
                            <div class="var_contents">
                                <img src="../assets/tmp.png" alt="" class="var_img">
                                <div class="added_var_info">
                                    <input type="text" disabled readonly name="" id="" placeholder="Green">
                                    <input type="text"  disabled readonly name="" id="" placeholder="₱30">
                                    <input type="text" disabled readonly name="" id="" placeholder="24pcs">
                                </div>
                            </div>
                            <div class="var_contents">
                                <img src="../assets/tmp.png" alt="" class="var_img">
                                <div class="added_var_info">
                                    <input type="text" disabled readonly name="" id="" placeholder="Green">
                                    <input type="text"  disabled readonly name="" id="" placeholder="₱30">
                                    <input type="text" disabled readonly name="" id="" placeholder="24pcs">
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>

                <!-- Add a variant type canvas -->
                <!-- <div class="offcanvas offcanvas-bottom"  data-bs-scroll="true" tabindex="-1" aria-labelledby="offcanvasBottomLabel" id="add_variant">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="">Variant Name</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    
                    <div class="offcanvas-body large" id="add_variant_body">
                        <input type="text" name="" id="add_variant_field" >
                        <button type="button" id="add_varaint_btn_canvas" data-bs-dismiss="offcanvas" aria-label="Close">Add Variant</button>
                    </div>
                </div> -->
                
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
                                    <input type="text" name="" id="variant_form_type">
                                </div>
                                <div class="variant_type_info">
                                    <label for="">Price</label>
                                    <input type="text" name="" id="variant_form_price">
                                </div>
                                <div class="variant_type_info">
                                    <label for="">Stock</label>
                                    <input type="text" name="" id="variant_form_stock">
                                </div>
                            </div>
                            <div class="variant_file">
                                <img src="../assets/tmp.png" alt="" class="variant_img">
                                <input type="file" name="variant_form_img" id="add_variant_type_img">
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
                <input type="submit" name="" id="" value="Add Item">
            </div>
        </div>
    </form>
    <script src="../js/seller_prod.js"></script>
</body>
</html>
