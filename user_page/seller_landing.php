<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/seller_landing.css">

<section id="seller_page_store_section">
    <div id="seller_page_store_wrapper">
        <div id="store_top_products_wrapper">
            <div id="store_top_products_container">
                <header id="store_top_products_header">
                    <div id="store_top_products_header_container">
                        <p>Top Products</p>
                        <p id="top_products_view">View More <i class="bi bi-chevron-right"></i></p>
                    </div>
                </header>

                <div id="top_store_wrapper">
                    <div id="top_store_container" class="d-flex overflow-auto">
                        <?php include('../utilities/item_loop.php') ?>
                        <?php include('../utilities/item_loop.php') ?>
                        <?php include('../utilities/item_loop.php') ?>
                        <?php include('../utilities/item_loop.php') ?>
                        <?php include('../utilities/item_loop.php') ?>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</section>