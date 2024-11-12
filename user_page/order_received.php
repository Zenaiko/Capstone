<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receiving Phase</title>
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

    .status-received {
      color: #28a745; 
      font-weight: bold;
    }

    .btn-confirm {
      background-color: #28a745; 
      color: white;
    }

    .btn-refund {
      background-color: #dc3545; 
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
        <p class="status-received">Status: Received</p>
        <h6 class="card-title">Order #123456</h6>
        <p><strong>Items:</strong> 2x Pizza, 1x Salad</p>
        <p><strong>Total:</strong> ₱700.00</p>
        <p><strong>Shipping Address:</strong> 123 Main St, Sample City</p>
        <button class="btn btn-primary submit-rating" onclick="confirmReceipt(123456)">Order Received</button>
        <button class="btn btn-primary submit-rating" onclick="requestRefund(123456)">Request Refund</button>
      </div>
    </div>

    <!-- Order Card 2 -->
    <div class="card mb-3">
      <div class="card-body">
        <p class="status-received">Status: Received</p>
        <h6 class="card-title">Order #123457</h6>
        <p><strong>Items:</strong> 1x Burger, 3x Fries</p>
        <p><strong>Total:</strong> ₱900.00</p>
        <p><strong>Shipping Address:</strong> 456 Another St, Sample City</p>
        <button class="btn btn-primary submit-rating" onclick="confirmReceipt(123457)">Order Received</button>
        <button class="btn btn-primary submit-rating" onclick="requestRefund(123457)">Request Refund</button>
      </div>
    </div>

    <!-- Order Card 3 -->
    <div class="card mb-3">
      <div class="card-body">
        <p class="status-received">Status: Received</p>
        <h6 class="card-title">Order #123458</h6>
        <p><strong>Items:</strong> 5x Sushi</p>
        <p><strong>Total:</strong> ₱1,500.00</p>
        <p><strong>Shipping Address:</strong> 789 Sample Ave, Sample City</p>
        <button class="btn btn-primary submit-rating" onclick="confirmReceipt(123458)">Order Received</button>
        <button class="btn btn-primary submit-rating" onclick="requestRefund(123458)">Request Refund</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmReceipt(orderId) {
      Swal.fire({
        title: 'Confirm Receipt',
        text: "Are you sure you want to confirm receipt of this order?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, confirm it!',
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Confirmed!',
            'The receipt has been confirmed.',
            'success'
          );
          // Hide the confirm button after confirming receipt
          document.querySelector(`button[onclick="confirmReceipt(${orderId})"]`).style.display = 'none';
        }
      });
    }

    function requestRefund(orderId) {
      Swal.fire({
        title: 'Request Refund',
        text: "Please provide a reason for the refund:",
        input: 'textarea',
        inputPlaceholder: 'Enter your reason here...',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Submit Refund Request',
        preConfirm: (reason) => {
          if (!reason) {
            Swal.showValidationMessage('Please enter a reason for the refund.');
          } else {
            return reason;
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Requested!',
            'Your refund request has been submitted with the reason: ' + result.value,
            'success'
          );
          document.querySelector(`button[onclick="requestRefund(${orderId})"]`).style.display = 'none';
        }
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
