$(".item_wrapper").on('click' , function(){
    window.location.assign('solo_item.php?item=' + this.id);
});

$(".item_cart").click(function(){
    console.log("a");
});