<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Details</title>
  <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">

</head>
<body>
<?php
(session_status() === PHP_SESSION_NONE)?session_start():null;
require_once("../utilities/initialize.php");
require_once("../db_api/db_get.php");
$active_delivery = $get_db->get_active_delivery($_SESSION["rider_num"]);
$delivery_info = $get_db->active_delivery_info($_SESSION["rider_num"]);
 ?>
  <?php 
    if($active_delivery){?>
<?php require_once('../utilities/back_button.php'); ?>

  <div class="container mt-4">
    <!-- Delivery Overview -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Delivery Overview</h6>
        <p><strong>Status: </strong><?=ucfirst($active_delivery["transaction_status"])?></p>
        <p><strong>Seller Name:</strong><?=$active_delivery["market_name"]?></p>
        <p><strong>Seller Address:</strong><?=$active_delivery["market_address"]?></p>
        <p><strong>Seller Contact:</strong><?=$active_delivery["market_contact"]?></p>
        <p><strong>Customer Name:</strong><?=$active_delivery["recipient_name"]?></p>
        <p><strong>Address:</strong><?=$active_delivery["customer_address"]?></p>
        <p><strong>Contact Number:</strong><?=$active_delivery["customer_contact"]?></p>
      </div>
    </div>
    <!-- Order Summary -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order Summary</h6>
        <ul>
          <?php foreach($delivery_info as $items){ ?>
            <li><?=$items["order_qty"]."X ".$items["item_name"]."(".$items["variation_name"].")"." - ₱".$items["order_price"]?></li>
          <?php } ?>
        </ul>
        <p><strong>Total Amount:</strong> ₱<?=$delivery_info[0]["total_transaction_amt"]?></p>
      </div>
    </div>
    <?php  ?>
    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-primary btn-custom" onclick="confirm_delivery('<?=$active_delivery['transaction_id']?>', this)"><?=($active_delivery["transaction_status"] != "delivered")?"Delivered":"Confirm Payment" ?></button>
    </div>
  </div>
<?php }else{
  echo "No active deliveries";
} ?>
  
<script>
  // Accept delivery
    function confirm_delivery(id, event) {
      action = (event.textContent).toLowerCase();
      if(action === "delivered"){
        Swal.fire({
          title: 'Are you sure?',
          text: "Is the delivery successful",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, I have completed the delivery',
          cancelButtonText: 'No, the orders hasn\'t been delivered '
        }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url : '../db_api/db_accept_order.php',
            type: 'POST',
            data: {transaction_id:id, action: "delivered"} ,
            success:function(stats){
              console.log(stats);
              if(stats === "success"){
                Swal.fire({
                  title: 'Accepted!',
                  text: 'You have confirmed the delivery, please await for the seller\'s confirmation',
                  icon: 'success',
                  confirmButtonText: "Okay"
                }).then(()=>{
                  window.history.back();
                })
              }
            }
          })
        
          }
        });
      }else{
        Swal.fire({
        icon: 'info',
        title: "Select an image",
        text: "Send proof of payment",
        input: "file",
        inputAttributes: {
          "accept": "image/*",
          "aria-label": "Upload your profile picture"
          }
        }).then((image)=>{
          if (image.isConfirmed) {
            const file = image.value;
            if(file){
              const form_data = new FormData();
              form_data.append('action', 'confirm_payment');
              form_data.append('transaction_id', id);
              form_data.append('payment', file);
              $.ajax({
                url: '../db_api/db_accept_order.php',
                type: 'POST',
                data:form_data,
                processData: false,
                contentType: false,
                success:function(stat){
                  if(stat === "success"){
                    Swal.fire({
                      icon: 'success',
                      title: "Image Sent",
                      text: "Please await for confirmation",
                    }).then(()=>{
                      window.history.back();
                    })
                  }
                }
              })
            }
          }
      
        });
      }
 
  }
</script>

</body>
</html>
