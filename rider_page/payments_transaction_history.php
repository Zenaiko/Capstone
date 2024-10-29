<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payments Transaction History</title>
</head>
<style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    h4 {
      color: #20263e;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .btn-custom {
      background-color: #508d4e;
      border-color: #508d4e;
      color: #fff;
      border-radius: 20px;
      padding: 10px 20px;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #40A578;
    }

</style>
<body>
<?php require_once("../utilities/initialize.php"); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
      <a href="rider_landing.php" class="btn btn-outline-primary">Back</a>
      <div></div>
    </div>
    
    <!-- Seller Info Card 1 -->
    <div class="card mb-3" id="payment-card-1">
      <div class="card-body">
        <h6 class="card-title">Seller Information</h6>
        <p><strong>Seller Name:</strong> CJshabu</p>
        <p><strong>Address:</strong> 123 Main St, City</p>
        <p><strong>Contact Number:</strong> (69) 456-7890</p>
        <p><strong>GCash:</strong> 09123456789</p>
        <p id="status-text-1"><strong>Status:</strong> <span id="status-1">Pending</span></p> <!-- Initial Status -->
        <div class="d-flex justify-content-center" id="button-container-1">
          <button class="btn btn-outline-primary btn-custom" onclick="confirmPayment(1)">Payment Sent</button>
        </div>
      </div>
    </div>

    <!-- Seller Info Card 2 -->
    <div class="card mb-3" id="payment-card-2">
      <div class="card-body">
        <h6 class="card-title">Seller Information</h6>
        <p><strong>Seller Name:</strong> FoodHub</p>
        <p><strong>Address:</strong> 456 Elm St, City</p>
        <p><strong>Contact Number:</strong> (69) 123-4567</p>
        <p><strong>GCash:</strong> 09129876543</p>
        <p id="status-text-2"><strong>Status:</strong> <span id="status-2">Pending</span></p> 
        <div class="d-flex justify-content-center" id="button-container-2">
          <button class="btn btn-outline-primary btn-custom" onclick="confirmPayment(2)">Payment Sent</button>
        </div>
      </div>
    </div>

    <!-- Seller Info Card 3 -->
    <div class="card mb-3" id="payment-card-3">
      <div class="card-body">
        <h6 class="card-title">Seller Information</h6>
        <p><strong>Seller Name:</strong> SnackWorld</p>
        <p><strong>Address:</strong> 789 Pine St, City</p>
        <p><strong>Contact Number:</strong> (69) 987-6543</p>
        <p><strong>GCash:</strong> 09125678904</p>
        <p id="status-text-3"><strong>Status:</strong> <span id="status-3">Pending</span></p> 
        <div class="d-flex justify-content-center" id="button-container-3">
          <button class="btn btn-outline-primary btn-custom" onclick="confirmPayment(3)">Payment Sent</button>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Function to handle the payment sent confirmation
    function confirmPayment(cardNumber) {
      Swal.fire({
        title: 'Confirm Payment',
        text: "Are you sure you want to mark this payment as sent?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send it!',
      }).then((result) => {
        if (result.isConfirmed) {
          // Change the status text to "Payment Sent"
          document.getElementById("status-" + cardNumber).innerText = "Payment Sent";
          document.getElementById("status-text-" + cardNumber).classList.add("status"); 

          // Remove the button from the DOM
          document.getElementById("payment-button-" + cardNumber).remove();

          Swal.fire(
            'Sent!',
            'Payment has been marked as sent.',
            'success'
          );
          // Here you can add any logic to handle the payment update
        }
      });
    }
  </script>
</body>
</html>