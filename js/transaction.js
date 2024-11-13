var transaction_loader = document.getElementById("transaction_loader");

$(".transac_tab").on('click', function(){
    const tab_id = $(this).attr('id');
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
            attachEventHandlers();
        }
    });
});

// rerurns a bool to determine the status
function check_class_contains(element, status) {
    // Validate inputs
    if (!(element instanceof HTMLElement || element instanceof jQuery)) {
        return false;
    }
    
    if (typeof status !== 'string') {
        return false;
    }

    // If element is a jQuery object, get the native DOM element
    const domElement = element instanceof jQuery ? element[0] : element;

    // Check if the DOM element has the specified class
    return domElement.classList.contains(status);
}

// Use event delegation to handle clicks on dynamically added .accept-btns
$(document).on("click", ".order_btn", function() {
    const basis_id = ($(this).attr("id"));

    // Determines the status action by viewing the class name
    const accept = check_class_contains($(this), "accept-btn");
    const decline = check_class_contains($(this), "reject-btn");
    const prepared = check_class_contains($(this),"prepare-btn");

    switch(true){
        case(accept):
            stats = "accepted"
            break;
        case(decline):
            stats = "declined"
            break;
        case(prepared):
            stats = "prepared"
            break;
    }
    $.ajax({
        url: "../db_api/db_updt_order_stat.php",
        type: "POST",
        data: {basis_id:basis_id, stats:stats},
        success(results){
            console.log(results);
        }

    });
});
