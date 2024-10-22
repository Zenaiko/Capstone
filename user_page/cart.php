<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cart Page</title>
    <style>
        .center-button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px; 
        }
        
        .btn-primary {
            padding: 10px 30px; 
            font-size: 16px;    
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav id="navbar">
        <button id="backButton" class="navbar-button">Back</button>
        <button id="editButton" class="navbar-button">Edit</button>
    </nav>

    <!-- Cart Section -->
    <section id="cart_section">
        <div class="seller_cart_wrapper">
            <div class="seller_cart_contents">
                <div class="seller_cart_name_container">
                    <input type="checkbox" class="cart_seller_checkbox">
                    <p class="seller_cart_name">Store 1</p>
                    <span class="delete-store"><i class="bi bi-trash"></i></span> 
                </div>
                <div class="seller_items_wrapper">
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 01</p>
                            <p class="item_cart_price">₱20</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash" onclick="changeQuantity(event, -1)"></i>
                                <p class="cart_item_qty">1</p>
                                <i class="bi bi-plus" onclick="changeQuantity(event, 1)"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 02</p>
                            <p class="item_cart_price">₱50</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash" onclick="changeQuantity(event, -1)"></i>
                                <p class="cart_item_qty">3</p>
                                <i class="bi bi-plus" onclick="changeQuantity(event, 1)"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="seller_cart_wrapper">
            <div class="seller_cart_contents">
                <div class="seller_cart_name_container">
                    <input type="checkbox" class="cart_seller_checkbox">
                    <p class="seller_cart_name">Store 2</p>
                    <span class="delete-store"><i class="bi bi-trash"></i></span> 
                </div>
                <div class="seller_items_wrapper">
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 01</p>
                            <p class="item_cart_price">₱20</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash" onclick="changeQuantity(event, -1)"></i>
                                <p class="cart_item_qty">1</p>
                                <i class="bi bi-plus" onclick="changeQuantity(event, 1)"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 02</p>
                            <p class="item_cart_price">₱50</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash" onclick="changeQuantity(event, -1)"></i>
                                <p class="cart_item_qty">3</p>
                                <i class="bi bi-plus" onclick="changeQuantity(event, 1)"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Center Button Container -->
    <div class="center-button-container">
        <button class="btn btn-primary" id="checkoutButton">Checkout</button>
    </div>

    <script>
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
                    button.style.display = editMode ? 'inline' : 'none'; 
                });
                deleteItemButtons.forEach(button => {
                    button.style.display = editMode ? 'inline' : 'none'; 
                });
            });

            
            const deleteStoreButtons = document.querySelectorAll('.delete-store');
            deleteStoreButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const storeWrapper = button.closest('.seller_cart_wrapper');
                    storeWrapper.remove(); 
                });
            });

            // Remove item functionality
            const deleteItemButtons = document.querySelectorAll('.delete-item');
            deleteItemButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const itemWrapper = button.closest('.seller_item');
                    const storeWrapper = button.closest('.seller_cart_wrapper');
                    itemWrapper.remove(); 

                    const remainingItems = storeWrapper.querySelectorAll('.seller_item');
                    if (remainingItems.length === 0) {
                        storeWrapper.remove(); 
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

        // Function to change item quantity
        function changeQuantity(event, change) {
            const quantityElement = event.target.parentNode.querySelector('.cart_item_qty');
            let quantity = parseInt(quantityElement.textContent);
            quantity += change;

            if (quantity < 1) {
                quantity = 1;
            }
            quantityElement.textContent = quantity;
        }

        // Checkout Button Confirmation
        document.getElementById('checkoutButton').addEventListener('click', function () {
            Swal.fire({
                title: 'Confirm Checkout',
                text: "Are you sure you want to proceed to checkout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Checkout'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success!',
                        'Your items have been checked out.',
                        'success'
                    );
                    // Redirect to the checkout page or handle checkout logic here
                }
            });
        });
    </script>
</body>
</html>
