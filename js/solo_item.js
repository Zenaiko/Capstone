$(document).ready(function(){
    $('.carousel-item').eq(0).each(function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
        }
    });
})

$(".cus_rel").click(function(){
    let action = $(this).attr("id");
    let rel_id;
    if (action === "follow_seller"){
        rel_id =  $(this).data('seller-id');
    }else{
        // Get the current URL
        const currentUrl = window.location.href;
        // Create a URL object
        const url = new URL(currentUrl);
        // Use URLSearchParams to get the 'item' parameter
        rel_id = url.searchParams.get('item');
    }
    $.ajax({
        url: "../db_api/db_cus_rel.php",
        type: "POST",
        data: {rel_id:rel_id , action: action},
    });
});
