$(document).ready(function() {
    const itemsSection = document.getElementById('items-section');

    $(".tab").on("click", function(){
        let tab_name = $(this).attr("id");
        if(["live", "sold_out", "delisted"].includes(tab_name)){
            page_to_load = "seller_item_status.php";
        }else{

        }
        $.ajax({
            url: page_to_load,
            type: "POST",
            data: {action:tab_name},
            success:function(page){
                itemsSection.innerHTML = page;
            },error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error: ' + textStatus + ', ' + errorThrown);
            }
        })
    })

    $(document).on('click', '.delist-btn', function() {
            const item_id = $(this).attr("id");
            let action = ($(this).val()).toLowerCase();
            action = (action === "delist") ? "delisted" : "live";
            $.ajax({
            url: "../db_api/db_get_ajax.php",
            type: "POST",
            data: {item_id:item_id, action: action}
        })
    });
});
