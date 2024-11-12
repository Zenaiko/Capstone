<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping Phase</title>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    h4, h6 {
      color: #20263e;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .status-shipping {
      color: #17a2b8; 
      font-weight: bold;
    }

    .btn-track {
      background-color: #007bff; 
      color: white;
    }
  </style>
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>
<?php require_once('../utilities/initialize.php'); ?>
 <div class="container mt-4">
    <!-- Order Card 1 -->
    <div class="card mb-3">
      <div class="card-body">
      <p class="status-shipping">Status: Shipping</p>
        <h6 class="card-title">Order #123456</h6>
        <p><strong>Items:</strong> 2x Pizza, 1x Salad</p>
        <p><strong>Total:</strong> ₱700.00</p>
        <p><strong>Shipping Address:</strong> 123 Main St, Sample City</p>
      </div>
    </div>

    <!-- Order Card 2 -->
    <div class="card mb-3">
      <div class="card-body">
      <p class="status-shipping">Status: Shipping</p>
        <h6 class="card-title">Order #123457</h6>
        <p><strong>Items:</strong> 1x Burger, 3x Fries</p>
        <p><strong>Total:</strong> ₱900.00</p>
        <p><strong>Shipping Address:</strong> 456 Another St, Sample City</p>
      </div>
    </div>

    <!-- Order Card 3 -->
    <div class="card mb-3">
      <div class="card-body">
      <p class="status-shipping">Status: Shipping</p>
        <h6 class="card-title">Order #123458</h6>
        <p><strong>Items:</strong> 5x Sushi</p>
        <p><strong>Total:</strong> ₱1,500.00</p>
        <p><strong>Shipping Address:</strong> 789 Sample Ave, Sample City</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
