var transaction_loader = document.getElementById("transaction_loader");

$(".transac_tab").on('click', function(){
    const tab_id = $(this).attr('id')
    let load_page;
    switch(tab_id.toLowerCase()){
        case "requesting":
            load_page = "transaction_request.php";
            break;
        case "processing":
            load_page = "transaction_processing.php";
            break;
        case "shipping":
            load_page = "transaction_shipping.php";
            break;
        case "failed_delivery":
            load_page = "transaction_failed_delivery.php";
            break;
        case "completed":
            load_page = "transaction_completed.php";
            break;
        case "canceled":
            load_page = "transaction_cancelled.php";
            break;
        case "cancel_request":
            load_page = "";
            break;
    }

    $.ajax({
        url: load_page,
        success: function(page){
            transaction_loader.innerHTML = page;
        }
    });
});