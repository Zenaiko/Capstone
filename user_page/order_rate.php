<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rate Your Products</title>
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

    .star {
      cursor: pointer;
      font-size: 24px;
      color: #ccc; 
    }

    .star:hover {
      color: #ffdb58; 
    }

    .rated {
      color: #ffcc00;
    }

    .submit-rating {
      display: none; 
      margin-top: 10px;
    }
  </style>
</head>
<body>
<?php require_once('../utilities/initialize.php'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
      <a href="order_transaction_history.php" class="btn btn-outline-primary">Back</a>
      <div></div> 
    </div>
    <!-- Product Card 1 -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order #123456 - Pizza</h6>
        <p><strong>Item:</strong> 2x Pizza</p>
        <div class="rating" id="rating-123456">
          <span class="star" onclick="selectRating(123456, 1)">&#9733;</span>
          <span class="star" onclick="selectRating(123456, 2)">&#9733;</span>
          <span class="star" onclick="selectRating(123456, 3)">&#9733;</span>
          <span class="star" onclick="selectRating(123456, 4)">&#9733;</span>
          <span class="star" onclick="selectRating(123456, 5)">&#9733;</span>
        </div>
        <button class="btn btn-primary submit-rating" id="submit-123456" onclick="confirmRating(123456)">Submit Rating</button>
      </div>
    </div>

    <!-- Product Card 2 -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order #123457 - Burger</h6>
        <p><strong>Item:</strong> 1x Burger</p>
        <div class="rating" id="rating-123457">
          <span class="star" onclick="selectRating(123457, 1)">&#9733;</span>
          <span class="star" onclick="selectRating(123457, 2)">&#9733;</span>
          <span class="star" onclick="selectRating(123457, 3)">&#9733;</span>
          <span class="star" onclick="selectRating(123457, 4)">&#9733;</span>
          <span class="star" onclick="selectRating(123457, 5)">&#9733;</span>
        </div>
        <button class="btn btn-primary submit-rating" id="submit-123457" onclick="confirmRating(123457)">Submit Rating</button>
      </div>
    </div>

    <!-- Product Card 3 -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order #123458 - Sushi</h6>
        <p><strong>Item:</strong> 5x Sushi</p>
        <div class="rating" id="rating-123458">
          <span class="star" onclick="selectRating(123458, 1)">&#9733;</span>
          <span class="star" onclick="selectRating(123458, 2)">&#9733;</span>
          <span class="star" onclick="selectRating(123458, 3)">&#9733;</span>
          <span class="star" onclick="selectRating(123458, 4)">&#9733;</span>
          <span class="star" onclick="selectRating(123458, 5)">&#9733;</span>
        </div>
        <button class="btn btn-primary submit-rating" id="submit-123458" onclick="confirmRating(123458)">Submit Rating</button>
      </div>
    </div>
  </div>

  <script>
    // Object to store selected ratings
    const ratings = {};

    // Function to handle star selection
    function selectRating(orderId, rating) {
      // Store the selected rating
      ratings[orderId] = rating;

      // Find the rating container by ID
      const ratingContainer = document.getElementById(`rating-${orderId}`);
      const stars = ratingContainer.querySelectorAll('.star');

      // Clear previous ratings
      stars.forEach((star, index) => {
        star.classList.remove('rated');
      });

      // Mark the selected rating and subsequent stars as rated
      for (let i = 0; i < rating; i++) {
        stars[i].classList.add('rated');
      }

      // Show the submit button
      document.getElementById(`submit-${orderId}`).style.display = 'block';
    }

    // Function to confirm rating submission
    function confirmRating(orderId) {
      const rating = ratings[orderId];

      // Check if a rating has been selected
      if (rating) {
        // Display a confirmation alert using SweetAlert
        Swal.fire({
          title: 'Confirm Your Rating',
          text: `You rated Order #${orderId} with ${rating} star(s). Do you want to submit this rating?`,
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Yes, submit it!',
          cancelButtonText: 'No, go back'
        }).then((result) => {
          if (result.isConfirmed) {
            // Display a success message after submission
            Swal.fire({
              title: 'Thank You for Your Rating',
              text: `You rated Order #${orderId} with ${rating} star(s)!`,
              icon: 'success',
              confirmButtonText: 'OK'
            });

            // Disable further rating
            const stars = document.getElementById(`rating-${orderId}`).querySelectorAll('.star');
            stars.forEach(star => {
              star.style.pointerEvents = 'none'; // Disable clicks on stars
            });

            // Hide the submit button after submission
            document.getElementById(`submit-${orderId}`).style.display = 'none';
          }
        });
      } else {
        // Alert if no rating is selected
        Swal.fire({
          title: 'No Rating Selected',
          text: 'Please select a rating before submitting.',
          icon: 'warning',
          confirmButtonText: 'OK'
        });
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
