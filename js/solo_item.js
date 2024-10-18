$(document).ready(function(){
    $('.carousel-item').eq(0).each(function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
        }
    });
})

// Get the current URL
const currentUrl = window.location.href;

// Create a URL object
const url = new URL(currentUrl);

// Use URLSearchParams to get the 'seller' parameter
const item_id = url.searchParams.get('item'); // Change 'id' to 'seller' 

$("#solo_item_like").click(function(){
    $.ajax({
        url: "../db_api/db_like_item.php",
        type: "POST",
        data: {item_id:item_id , action: "like"},
       
    });
});