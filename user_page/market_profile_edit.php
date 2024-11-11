<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Seller Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    h4 {
      color: #20263e;
      text-align: center;
      margin: 20px 0;
    }

    .profile-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
    }

    .market-profile-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #007bff;
    }

    .form-container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .form-group label {
      font-weight: bold;
    }

    .btn-save {
      background-color: #28a745;
      color: white;
      width: 100%;
      font-weight: bold;
      display: block; 
    }

    .preview-container {
      display: flex;
      overflow-x: auto;
      margin-top: 10px; 
      gap: 10px; 
    }

    .preview-item {
      display: flex;
      flex-direction: column; 
      align-items: center; 
      width: 100px; 
    }

    .preview-image {
      width: 100px; 
      height: 100px;
      border-radius: 5px;
      object-fit: cover;
    }

    .remove-btn {
      background-color: #dc3545; 
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 5px;
      padding: 5px 10px; 
    }
  </style>
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>
  <div class="container mt-4">

  <!-- Profile Picture -->
  <div class="container">
    <div class="profile-container">
      <img src="market-profile.jpg" alt="Market Profile Image" class="market-profile-img mb-3" id="marketProfilePreview">
      <input type="file" class="form-control w-50" accept="image/*" id="marketProfileInput" onchange="previewMarketProfilePicture(event)">
    </div>

    <!-- Form  -->
    <div class="form-container">
      <form>
        <!-- Market Name -->
        <div class="mb-3">
          <label for="marketName" class="form-label">Market Name</label>
          <input type="text" class="form-control" id="marketName" placeholder="Market Name">
        </div>

        <!-- Market Description -->
        <div class="mb-3">
          <label for="marketDesc" class="form-label">Market Description</label>
          <textarea class="form-control" id="marketDesc" rows="3" placeholder="Market Description"></textarea>
        </div>

        <!-- Market Contact -->
        <div class="mb-3">
          <label for="sellerContact" class="form-label">Market Contact</label>
          <input type="number" class="form-control" id="sellerContact" placeholder="Seller Contact Number">
        </div>

        <!-- Market Featured Images -->
        <div class="mb-3">
          <label for="marketFeaturedInput" class="form-label">Market Featured Images</label>
          <input type="file" class="form-control" accept="image/*" id="marketFeaturedInput" multiple onchange="previewMarketFeaturedImages(event)">
          <div class="preview-container" id="previewContainer"></div>
        </div>

        <!-- Save Button -->
        <input type="button" class="btn btn-save mt-4" id="saveButton" value="Save">

      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let uploadedImages = [];

    function previewMarketProfilePicture(event) {
      const input = event.target;
      const reader = new FileReader();

      reader.onload = function() {
        const marketProfilePreview = document.getElementById('marketProfilePreview');
        marketProfilePreview.src = reader.result;
      }

      if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
      }
    }

    function previewMarketFeaturedImages(event) {
      const input = event.target;
      const previewContainer = document.getElementById('previewContainer');
      const files = Array.from(input.files); 

      for (const file of files) {
        if (uploadedImages.length < 5) {
          const reader = new FileReader();
          reader.onload = function() {
            const img = document.createElement('img');
            img.src = reader.result;
            img.className = 'preview-image';

            const removeBtn = document.createElement('button');
            removeBtn.innerText = 'Remove';
            removeBtn.className = 'remove-btn';
            removeBtn.onclick = function() {
              // Remove image from the uploadedImages array
              uploadedImages = uploadedImages.filter(item => item !== img.src);
              previewContainer.removeChild(previewItem);
              toggleUploadInput();
            };

            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';
            previewItem.appendChild(img);
            previewItem.appendChild(removeBtn);

            // Add image to the uploadedImages array
            uploadedImages.push(reader.result);
            previewContainer.appendChild(previewItem);

            // Disable input if we reach the limit
            if (uploadedImages.length >= 5) {
              input.disabled = true; 
            }
          }
          reader.readAsDataURL(file);
        }
      }
    }

    function toggleUploadInput() {
      const input = document.getElementById('marketFeaturedInput');
      input.disabled = uploadedImages.length >= 5; 
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
