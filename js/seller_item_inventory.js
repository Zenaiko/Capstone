// Tab switching logic
const tabs = document.querySelectorAll('.tab');
const indicator = document.querySelector('.tab-indicator');
const scrollableTabs = document.querySelector('.scrollable-tabs');
const itemsSection = document.getElementById('items-section');

// Function to update the tab indicator position
function updateIndicatorPosition(tab) {
    const tabRect = tab.getBoundingClientRect();
    indicator.style.width = `${tabRect.width}px`;
    indicator.style.left = `${tabRect.left - scrollableTabs.getBoundingClientRect().left}px`;
}

function loadContent(tabName) {
    let pageToLoad;

    switch (tabName) {
        case 'live':
            pageToLoad = 'seller_item_inventory_live.php';
            break;
        case 'sold-out':
            pageToLoad = 'seller_item_inventory_sold.php';
            break;
        case 'reviewing':
            pageToLoad = 'seller_item_inventory_reviewing.php';
            break;
        case 'violation':
            pageToLoad = 'seller_item_inventory_violation.php';
            break;
        case 'unpublished':
            pageToLoad = 'seller_item_inventory_unpublished.php';
            break;
        case 'history':
            pageToLoad = 'seller_item_inventory_history.php';
            break;
        default:
            pageToLoad = 'seller_item_inventory_live.php'; 
    }

    // AJAX request to load the content
    const xhr = new XMLHttpRequest();
    xhr.open("GET", pageToLoad, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            itemsSection.innerHTML = xhr.responseText;
        } else {
            console.error("Error loading content:", xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error("Request failed.");
    };
    xhr.send();
}

// Event listener for tab clicks
tabs.forEach(tab => {
    tab.addEventListener('click', (e) => {
   
        tabs.forEach(t => t.classList.remove('active'));

        e.target.classList.add('active');

        updateIndicatorPosition(e.target);
     
        const tabName = e.target.dataset.tab;
        loadContent(tabName);
    });
});

// Initial setup: set indicator position and load content for the first active tab
document.addEventListener('DOMContentLoaded', () => {
    const activeTab = document.querySelector('.tab.active');
    updateIndicatorPosition(activeTab);
    loadContent('live');  
});



