function updateQuantity(element, change) {
    const quantityInput = element.closest('.item_counter_wrapper').querySelector('.cart_item_qty');
    let currentQuantity = parseInt(quantityInput.value);
    currentQuantity += change;
    
    if (currentQuantity < 1) currentQuantity = 1; 

    quantityInput.value = currentQuantity;
    checkQuantity(quantityInput); 
}

function checkQuantity(input) {
    const quantity = parseInt(input.value);
    const itemId = input.getAttribute('data-id');
    const itemElement = document.getElementById('item-' + itemId);
    
    if (quantity <= 0) {
        deleteItem(itemElement, itemId); 
    }
}

function deleteItem(button, variationId) {
    const itemRow = button.closest('.seller_item');
    itemRow.remove(); 

    const marketWrapper = itemRow.closest('.seller_cart_wrapper');
    const remainingItems = marketWrapper.querySelectorAll('.seller_item');
    
    if (remainingItems.length === 0) {
        marketWrapper.remove();
    }
}