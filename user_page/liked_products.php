<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liked Products</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #508D4E;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 200px;
            object-fit: cover;
        }
        .btn-remove {
            color: #c82333;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-remove:hover {
            text-decoration: underline;
        }
        .card-title a {
            color: #20263e;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
        }
        .card-title a:hover {
            color: #508D4E;
        }
    </style>
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>
<div class="container mt-4">
    <!-- Liked Items Grid -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Sample Liked Item Card -->
        <div class="col">
            <div class="card h-100">
                <img src="https://via.placeholder.com/400x300?text=Product+Image" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Product Name</a></h5>
                    <p class="card-text">₱1,299.00</p>
                    <a href="#" class="btn btn-outline-primary btn-sm mb-2">View Product</a>
                    <br>
                    <span class="btn-remove" onclick="confirmRemove(this)">Remove from Liked Items</span>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="https://via.placeholder.com/400x300?text=Product+Image" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Product Name</a></h5>
                    <p class="card-text">₱1,299.00</p>
                    <a href="#" class="btn btn-outline-primary btn-sm mb-2">View Product</a>
                    <br>
                    <span class="btn-remove" onclick="confirmRemove(this)">Remove from Liked Items</span>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <img src="https://via.placeholder.com/400x300?text=Product+Image" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><a href="product_details.php">Product Name</a></h5>
                    <p class="card-text">₱1,299.00</p>
                    <a href="product_details.php" class="btn btn-outline-primary btn-sm mb-2">View Product</a>
                    <br>
                    <span class="btn-remove" onclick="confirmRemove(this)">Remove from Liked Items</span>
                </div>
            </div>
        </div>
    
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmRemove(element) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this item from your liked list?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c82333',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulate removal of item
                element.closest('.col').remove();
                Swal.fire(
                    'Removed!',
                    'The item has been removed from your liked list.',
                    'success'
                );
            }
        });
    }
</script>
</body>
</html>
