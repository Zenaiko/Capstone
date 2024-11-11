<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rider Homepage</title>
</head>
<style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    h5, h6 {
      color: #20263e;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .card-body {
      padding: 15px;
    }

    .btn-toggle {
      background-color: #40A578;
      color: #fff;
      border-radius: 20px;
      padding: 5px 15px;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .btn-toggle.active {
      background-color: #c82333;
    }

    .btn-toggle:hover {
      background-color: #508d4e;
    }

    .btn-primary {
      background-color: #508d4e;
      border-color: #508d4e;
    }

    .btn-outline-primary {
      border-color: #508d4e;
      color: #508d4e;
    }

    .map-placeholder {
      background-color: #e9ecef;
      border-radius: 10px;
      padding: 30px;
      text-align: center;
      color: #6c757d;
      height: 100px;
    }

    .map-placeholder p {
      margin: 0;
      font-size: 14px;
    }
</style>
<body>
<?php 
(session_status() === PHP_SESSION_NONE)?session_start():null;
require_once("../utilities/initialize.php");
require_once("../db_api/db_get.php");
$active_delivery = $get_db->get_active_delivery($_SESSION["rider_num"]);
?>
<div class="container mt-4">
  <!-- Rider Status -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="dashboard-title">Rider Dashboard</h4>
  </div>

  <!-- Quick Access Cards -->
  <div class="card mb-3">
    <div class="card-body">
      <h6 class="card-title">Active Deliveries</h6>
      <p class="card-text"><?=($active_delivery)?"You have an ongoing delivery":"You have no ongoing delivery"?></p>
      <a href="view_details.php" class="btn btn-outline-primary btn-sm">View Details</a>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <h6 class="card-title">Delivery Requests</h6>
      <a href="new_requests.php" id="view_request" class="btn btn-outline-primary btn-sm">View Requests</a>
    </div>
  </div>

  <!-- Navigation Shortcuts -->
  <div class="d-flex justify-content-between my-4">
      <a href="order_history.php" class="btn btn-primary w-100 ms-2">Order History</a>
  </div>
  
  <div class="d-flex justify-content-between my-4">
      <a href="payments_transaction_history.php" class="btn btn-primary w-100 ms-2">Payments Transaction History</a>
  </div>
</div>

<script>
  if(<?=$active_delivery["rider_id"]?>){
    $("#view_request").click(function(event){
      event.preventDefault();
      Swal.fire({
        icon: "error",
        title: "Active Delivery",
        text: "You have already accepted a delivery"
      });
    });
  }
</script>

</body>
</html>
