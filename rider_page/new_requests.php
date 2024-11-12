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
<?php require_once('../utilities/back_button.php'); ?>
<?php require_once("../utilities/initialize.php");
require_once("../db_api/db_get.php");
$order_requests = $get_db->get_all_orders();?>
  <div class="container mt-4">
    <?php foreach($order_requests as $orders){?>
    <div class="card mb-3" id="request-1">
      <div class="card-body">
        <h6 class="card-title">Delivery Request from <strong><?=$orders["market_name"]?></strong></h6>
        <p><strong>Pickup Address: </strong><?=$orders["market_adr"]?></p>
        <p><strong>Pickup Contact: </strong><?=$orders["market_contact"]?></p>
        <h6 class="card-title">Recepient: <strong><?=$orders["recipient_name"]?></strong></h6>
        <p><strong>Drop-off Address: </strong><?=$orders["customer_adr"]?></p>
        <p><strong>Recepient Contact: </strong><?=$orders["customer_contact"]?></p>
        <div class="d-flex justify-content-between">
          <button class="btn btn-outline-primary btn-custom" onclick="acceptRequest('<?=$orders['transaction_id']?>')">Accept</button>
        </div>
      </div>
    </div>
    <?php } ?>
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
          $.ajax({
            url : '../db_api/db_accept_order.php',
            type: 'POST',
            data: {transaction_id:id} ,
            success:function(r){
              console.log(r);
            }
          })
            Swal.fire(
              'Accepted!',
              'You have accepted the delivery request.',
              'success'
            );
        }
      });
    }

    // Function to handle declining a request with SweetAlert confirmation
    // function declineRequest(id) {
    //   Swal.fire({
    //     title: 'Are you sure?',
    //     text: "Do you want to decline this delivery request?",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, decline it!'
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       const requestCard = document.getElementById(id);
    //       if (requestCard) {
    //         Swal.fire(
    //           'Declined!',
    //           'You have declined the delivery request.',
    //           'error'
    //         );
    //         requestCard.remove(); // Remove the card after declining
    //       }
    //     }
    //   });
    // }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
