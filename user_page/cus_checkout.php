<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/customer_checkout.css">
</head>
<body>

    <div class="checkout-container">
        <!-- Header -->
        <header class="checkout-header">
            <button class="back-btn">←</button>
            <h1>Checkout</h1>
        </header>

        <!-- Shipping Section -->
        <section class="section">
            <h2 class="section-title">Shipping Address</h2>
            <div class="section-content">
                <p>The Hotdog Seller</p>
                <p>1234 Street Name, City</p>
            </div>
        </section>

        <!-- Customer Contact Section -->
        <section class="section">
            <h2 class="section-title">Contact Number</h2>
            <div class="section-content">
                <p>+63 912 345 6789</p> 
            </div>
        </section>

        <!-- Cart Items Section -->
        <section class="section">
            <h2 class="section-title">Your Items</h2>
            <div class="cart-item">
                <img src="item1.jpg" alt="Item 1" class="item-img">
                <div class="item-info">
                    <p class="item-name">Item 1</p>
                    <p class="item-qty">Qty: 2</p>
                </div>
                <p class="item-price">₱20.00</p>
            </div>
            <div class="cart-item">
                <img src="item2.jpg" alt="Item 2" class="item-img">
                <div class="item-info">
                    <p class="item-name">Item 2</p>
                    <p class="item-qty">Qty: 1</p>
                </div>
                <p class="item-price">₱30.00</p>
            </div>
        </section>

        <!-- Order Summary Section -->
        <section class="section">
            <h2 class="section-title">Order Summary</h2>
            <div class="summary-item">
                <span>Items Subtotal</span>
                <span>₱50.00</span>
            </div>
            <div class="summary-item">
                <span>Shipping Fee</span>
                <span>₱5.00</span>
            </div>
            <div class="summary-item total">
                <span>Total</span>
                <span>₱55.00</span>
            </div>
        </section>

        <!-- Checkout Button -->
        <input type="submit" class="checkout-btn" value="Place Order">
    </div>

</body>
</html>
