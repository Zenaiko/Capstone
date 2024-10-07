var base_shop_dir = "seller_page.php";

$(".featured-shop-contents").on("click" , function(){
    const shop_id = $(this).attr("id");
    window.location.assign(base_shop_dir+"?"+shop_id)
})