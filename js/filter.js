document.getElementById("filterButton").addEventListener("click", function() {
    document.getElementById("filterSidebar").classList.add("active");
});

document.addEventListener("click", function(event) {
    var sidebar = document.getElementById("filterSidebar");
    var filterButton = document.getElementById("filterButton");

    if (!sidebar.contains(event.target) && event.target !== filterButton) {
        sidebar.classList.remove("active");
    }
});


    // Handle form submission with AJAX
    document.getElementById("filterForm").addEventListener("submit", function(event) {
        event.preventDefault(); 

        // Gather form data
        var formData = new FormData(this);

        // Create a new AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "filter_products.php?" + new URLSearchParams(formData).toString(), true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Replace the contents of the #search_contents with the new items
                document.getElementById("search_contents").innerHTML = xhr.responseText;
            } else {
                console.error("AJAX request failed with status: " + xhr.status);
            }
        };
        xhr.send();
    });