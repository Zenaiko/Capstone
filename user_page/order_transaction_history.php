<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order History</title>
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
      margin-bottom: 20px;
    }

    .order-status {
      font-weight: bold;
      text-transform: uppercase;
      font-size: 0.9rem;
    }

    .order-status.completed {
      color: #28a745;
    }

    .order-status.canceled {
      color: #dc3545;
    }

    .order-status.pending {
      color: #ffc107;
    }
  </style>
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>
<?php require_once("../utilities/initialize.php"); ?>
  <div class="container mt-4">

    <!-- Sample Order History Item -->
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="card-title">Order #123456</h6>
            <p><strong>Order Date:</strong> 2024-10-10</p>
            <p><strong>Order Summary:</strong> 2x Pizza, 1x Salad</p>
            <p><strong>Total:</strong> ₱1,200.00</p>
            <p class="order-status completed"><strong>Status:</strong> Completed</p>
          </div>
          <div>
            <a href="order_detailed_history.php" class="btn btn-outline-primary">View Details</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
