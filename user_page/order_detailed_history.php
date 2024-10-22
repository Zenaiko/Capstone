<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Details</title>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<?php require_once("../utilities/initialize.php"); ?>
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
      <a href="order_transaction_history.php" class="btn btn-outline-primary">Back</a>
      <div></div> 
    </div>

    <!-- Delivery Overview -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Delivery Overview</h6>
        <p><strong>Seller Name:</strong> CJshabu</p>
        <p><strong>Seller Address:</strong> hehe</p>
        <p><strong>Customer Name:</strong> Nicoteen69</p>
        <p><strong>Address:</strong> secret</p>
        <p><strong>Contact Number:</strong> (69) 456-7890</p>
      </div>
    </div>

    <!-- Order Summary -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order Summary</h6>
        <ul>
          <li>2x Pizza - ₱500</li>
          <li>1x Salad - ₱200</li>
        </ul>
        <p><strong>Total Amount:</strong> ₱700</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
