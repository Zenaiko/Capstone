let redirect = '';
$('.cus_acc_body_content').click(function(){
    var id = (this.id).toLowerCase();

    switch(id){
        case 'account':
            redirect = 'cus_acc_edit_page.php';
            break;
        case 'address':
            redirect = 'manage_address.php';
            break;
        case 'liked':
            redirect = '';
            break;
        case 'logout':
            redirect = '../db_api/db_logout.php';
            break;
        case 'help':
            redirect = 'help_center.php';
            break;
         case 'rider':
            redirect = '../rider_page/rider_login.php';
            break;
        case 'store':
            fetch('../db_api/db_get.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({action: 'get_is_seller'}) // Sending the variable
                }).then(is_seller => is_seller.json())
                // Check if customer is a seller
                .then(seller_info => {
                    if(seller_info.seller_requested !== false){
                        redirect = (seller_info.is_verified === 1)?'seller_dashboard.php':null;
                    }else{
                        redirect = 'sign_up_seller.php';
                    }
                    (redirect)?window.location.assign(redirect):Swal.fire({
                        title: 'Request already made',
                        text: 'Please wait for approval',
                        icon: 'info',
                        confirmButtonText: 'Okay'
                    });
                    return;
                    })
            return;
        default:
            redirect = '';
    }
    window.location.assign(redirect);

});

$(".order_status").click(function(){
    var stats = $(this).attr('id');
    var page = "order_"+stats+".php";
    window.location.assign(page);
});

// Placeholder data (idk how xhr works)
const orderCounts = {
    request: 2,    // Number of "Requested" orders
    accepted: 3,   // Number of "Accepted" orders
    shipping: 1,   // Number of "Shipped" orders
    received: 10,   // Number of "Delivered" orders
  };
  
  // Function to update the circle indicators
  function addIndicators() {
    for (const [status, count] of Object.entries(orderCounts)) {
      // Find the corresponding div by ID
      const statusDiv = document.getElementById(status);
  
      if (statusDiv) {
        // Remove existing indicator if any
        const existingIndicator = statusDiv.querySelector(".order-indicator");
        if (existingIndicator) existingIndicator.remove();
  
        // Create the indicator only if count > 0
        if (count > 0) {
          const indicator = document.createElement("div");
          indicator.className = "order-indicator";
          indicator.textContent = count; // Add the count as text
          statusDiv.appendChild(indicator);
        }
      }
    }
  }
  
  addIndicators();
  