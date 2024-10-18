var seller_loader = document.getElementById("seller_loader");
let load;

// Get the current URL
const currentUrl = window.location.href;

// Create a URL object
const url = new URL(currentUrl);

// Use URLSearchParams to get the 'seller' parameter
const seller_id = url.searchParams.get('seller'); // Change 'id' to 'seller'

$(".seller_tabs").on("click", function() {
    const tab = $(this).attr('id');

    switch(tab.toLowerCase()) {
        case "seller_store":
            load = "seller_landing.php";
            break;
        case "seller_products":
            load = "seller_products.php";
            break;
        case "seller_categories":
            load = ""; // Handle accordingly
            break;
    }

    $.ajax({
        url: load,
        data: { seller: seller_id }, // Use the correct seller_id
        success: function(page) {
            seller_loader.innerHTML = page;
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            seller_loader.innerHTML = "An error occurred while loading the content.";
        }
    });
});
