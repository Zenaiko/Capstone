<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="../css/product-add.css">
</head>
<body>
    <div class="form-container">

        <!-- Product Name Section -->
        <div class="section" id="product-name-section">
            <label for="product-name">Product Name</label>
            <span id="product-name-counter">0/100</span>
            <input type="text" id="product-name" placeholder="Product name" maxlength="100" oninput="updateCounter('product-name', 'product-name-counter', 100)">
        </div>

        <!-- Product Description Section -->
        <div class="section" id="description-section">
            <label for="description">Product Description</label>
            <span id="description-counter">0/500</span>
            <textarea id="description" placeholder="Product description" maxlength="500" oninput="updateCounter('description', 'description-counter', 500)"></textarea>
        </div>

        <!-- Category Section -->
        <div class="section" id="category-section">
            <span>Category</span>
            <a href="#" class="clickable-arrow">...</a>
        </div>

        <!-- Price Section -->
        <div class="section" id="price-section">
            <span>Price</span>
            <div class="price-input">
                <input type="text" id="price" placeholder="0.00">
            </div>
        </div>

        <!-- Stock Section -->
        <div class="section" id="stock-section">
            <span>Stock</span>
            <input type="text" id="stock" placeholder="Set">
        </div>

        <!-- Wholesale Section -->
        <div class="section" id="wholesale-section">
            <span>Wholesale</span>
            <a href="#" class="clickable-arrow">...</a>
        </div>

        <!-- Shipping Fee Section -->
        <div class="section" id="shipping-fee-section">
            <span>Shipping Fee</span>
            <div class="price-input">
                <input type="text" id="shipping-fee" placeholder="0.00" readonly>
            </div>
        </div>

        <!-- Condition Section -->
        <div class="section" id="condition-section">
            <span>Condition</span>
            <a href="#" class="clickable-arrow">...</a>
        </div>

        <!-- Upload Image Section -->
        <div class="section" id="upload-image-section">
            <span>Upload Images</span>
            <input type="file" id="upload-images" accept="image/*" multiple onchange="previewImages(event)">
            <div id="image-preview-container"></div>
        </div>

        <!-- Save and Publish Buttons -->
        <div class="buttons">
            <button id="save-btn">Save</button>
            <button id="publish-btn">Publish</button>
        </div>

    </div>

    <script>
        // Update the character counter
        function updateCounter(inputId, counterId, maxLength) {
            const input = document.getElementById(inputId);
            const counter = document.getElementById(counterId);
            counter.innerText = `${input.value.length}/${maxLength}`;
        }

        // Preview multiple images and add remove functionality
        function previewImages(event) {
            const files = event.target.files;
            const container = document.getElementById('image-preview-container');
            container.innerHTML = ''; 
            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgWrapper = document.createElement('div');
                        imgWrapper.className = 'image-preview-wrapper';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'image-preview';

                        const removeBtn = document.createElement('button');
                        removeBtn.className = 'remove-image-btn';
                        removeBtn.textContent = '×';
                        removeBtn.onclick = function() {
                            imgWrapper.remove();
                        };

                        imgWrapper.appendChild(img);
                        imgWrapper.appendChild(removeBtn);
                        container.appendChild(imgWrapper);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        // Dummy function to calculate shipping fee (replace with real calculation)
        function calculateShippingFee(weight, location) {
            // Example logic, replace with real calculation
            let fee = 100; 
            if (weight > 5) {
                fee += (weight - 5) * 10; 
            }
            if (location === 'remote') {
                fee += 50;
            }
            return fee;
        }

        // Example usage to update shipping fee (replace with real values)
        const shippingFee = calculateShippingFee(10, 'remote');
        document.getElementById('shipping-fee').value = ` ${shippingFee.toFixed(2)}`;
    </script>
</body>
</html>
