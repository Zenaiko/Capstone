document.addEventListener('DOMContentLoaded', () => {
    const sellerCheckboxes = document.querySelectorAll('.cart_seller_checkbox');
    const editButton = document.getElementById('editButton');
    let editMode = false;

    // Edit button functionality
    editButton.addEventListener('click', () => {
        editMode = !editMode;
        editButton.textContent = editMode ? 'Done' : 'Edit';
        const deleteStoreButtons = document.querySelectorAll('.delete-store');
        const deleteItemButtons = document.querySelectorAll('.delete-item');

        deleteStoreButtons.forEach(button => {
            button.style.display = editMode ? 'inline' : 'none'; // Show/hide delete store button
        });
        deleteItemButtons.forEach(button => {
            button.style.display = editMode ? 'inline' : 'none'; // Show/hide delete item button
        });
    });

    // Remove store functionality
    const deleteStoreButtons = document.querySelectorAll('.delete-store');
    deleteStoreButtons.forEach(button => {
        button.addEventListener('click', () => {
            const storeWrapper = button.closest('.seller_cart_wrapper');
            storeWrapper.remove(); // Remove the store wrapper
        });
    });

    // Remove item functionality
    const deleteItemButtons = document.querySelectorAll('.delete-item');
    deleteItemButtons.forEach(button => {
        button.addEventListener('click', () => {
            const itemWrapper = button.closest('.seller_item');
            const storeWrapper = button.closest('.seller_cart_wrapper');
            itemWrapper.remove(); // Remove the item

            // Check if there are any items left in the store
            const remainingItems = storeWrapper.querySelectorAll('.seller_item');
            if (remainingItems.length === 0) {
                storeWrapper.remove(); // Remove the store if no items left
            }
        });
    });

    // Select all items in the store when the store checkbox is checked
    sellerCheckboxes.forEach(sellerCheckbox => {
        sellerCheckbox.addEventListener('change', () => {
            const items = sellerCheckbox.closest('.seller_cart_contents').querySelectorAll('.item_cart_checkbox');
            items.forEach(itemCheckbox => {
                itemCheckbox.checked = sellerCheckbox.checked; // Match item checkbox state to seller checkbox
            });
        });
    });
});
