<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Requests</title>
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

    .btn-custom {
      padding: 8px 50px; 
      font-size: 16px; 
      border-radius: 8px; 
    }

  </style>
</head>
<body>
<?php require_once("../utilities/initialize.php"); ?>
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
      <a href="rider_landingpage.php" class="btn btn-outline-primary">Back</a>
      <div></div>
    </div>

    <!-- Sample Delivery Request -->
    <div class="card mb-3" id="request-1">
      <div class="card-body">
        <h6 class="card-title">Delivery Request from Jollihotdog</h6>
        <p><strong>Pickup Address:</strong> Cabanatuan</p>
        <p><strong>Drop-off Address:</strong> Secret</p>
        <p><strong>Contact:</strong> +63 913 574 1234</p>
        <div class="d-flex justify-content-between">
          <button class="btn btn-outline-primary btn-custom" onclick="acceptRequest('request-1')">Accept</button>
          <button class="btn btn-outline-danger btn-custom" onclick="declineRequest('request-1')">Decline</button>
        </div>
      </div>
    </div>

    <div class="card mb-3" id="request-2">
      <div class="card-body">
        <h6 class="card-title">Delivery Request from Jollihotdog</h6>
        <p><strong>Pickup Address:</strong> Cabanatuan</p>
        <p><strong>Drop-off Address:</strong> Secret</p>
        <p><strong>Contact:</strong> +63 913 574 1234</p>
        <div class="d-flex justify-content-between">
          <button class="btn btn-outline-primary btn-custom" onclick="acceptRequest('request-2')">Accept</button>
          <button class="btn btn-outline-danger btn-custom" onclick="declineRequest('request-2')">Decline</button>
        </div>
      </div>
    </div>

  <script>
    // Function to handle accepting a request with SweetAlert confirmation
    function acceptRequest(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to accept this delivery request?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, accept it!'
      }).then((result) => {
        if (result.isConfirmed) {
          const requestCard = document.getElementById(id);
          if (requestCard) {
            Swal.fire(
              'Accepted!',
              'You have accepted the delivery request.',
              'success'
            );
            requestCard.remove(); // Remove the card after accepting
          }
        }
      });
    }

    // Function to handle declining a request with SweetAlert confirmation
    function declineRequest(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to decline this delivery request?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, decline it!'
      }).then((result) => {
        if (result.isConfirmed) {
          const requestCard = document.getElementById(id);
          if (requestCard) {
            Swal.fire(
              'Declined!',
              'You have declined the delivery request.',
              'error'
            );
            requestCard.remove(); // Remove the card after declining
          }
        }
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
