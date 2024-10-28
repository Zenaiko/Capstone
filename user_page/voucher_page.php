<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vouchers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .btn-custom {
      padding: 10px 40px; /* Increased padding for wider buttons */
      font-size: 16px;
      border-radius: 8px;
    }

    .voucher-type-btn {
      cursor: pointer;
      padding: 10px 20px;
      font-weight: bold;
    }

    .active {
      color: white;
      background-color: #007bff;
      border-radius: 8px;
    }

    .section {
      display: none;
    }

    .active-section {
      display: block;
    }

    .card-title {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .badge {
      font-size: 14px;
    }

    .voucher-info {
      margin-top: 10px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <h4 class="mb-4">Vouchers</h4>
    <div class="d-flex justify-content-center mb-4">
      <span class="voucher-type-btn active" onclick="showSection('active')">Active Vouchers</span>
      <span class="voucher-type-btn" onclick="showSection('expired')">Expired Vouchers</span>
    </div>

    <!-- Active Vouchers Section -->
    <div id="active-vouchers" class="section active-section">
      <div class="card" id="voucher-1">
        <div class="card-body">
          <div class="card-title">
            <h6><strong>Voucher Name: Special Discount</strong></h6>
            <span class="badge bg-success">Active</span>
          </div>
          <div class="voucher-info">
            <p><strong>Code:</strong> VOUCHER20</p>
            <p><strong>Discount:</strong> 20% Off</p>
            <p><strong>Valid Until:</strong> 30th Oct 2024</p>
            <p><strong>Minimum Spend:</strong> PHP 500</p>
          </div>
          <div class="d-flex justify-content-between">
            <button class="btn btn-outline-primary btn-custom">Edit</button>
            <button class="btn btn-outline-primary btn-custom" onclick="endVoucher('voucher-1')">End</button>
          </div>
        </div>
      </div>

      <div class="card" id="voucher-1">
        <div class="card-body">
          <div class="card-title">
            <h6><strong>Voucher Name: Special Discount</strong></h6>
            <span class="badge bg-success">Active</span>
          </div>
          <div class="voucher-info">
            <p><strong>Code:</strong> VOUCHER20</p>
            <p><strong>Discount:</strong> 20% Off</p>
            <p><strong>Valid Until:</strong> 30th Oct 2024</p>
            <p><strong>Minimum Spend:</strong> PHP 500</p>
          </div>
          <div class="d-flex justify-content-between">
            <button class="btn btn-outline-primary btn-custom">Edit</button>
            <button class="btn btn-outline-primary btn-custom" onclick="endVoucher('voucher-1')">End</button>
          </div>
        </div>
      </div>
      
    </div>

    <!-- Expired Vouchers Section -->
    <div id="expired-vouchers" class="section">
      <div class="card" id="voucher-2">

      </div>
    </div>
  </div>

  <script>
    function showSection(section) {
      document.querySelector('.voucher-type-btn.active').classList.remove('active');
      document.getElementById('active-vouchers').classList.remove('active-section');
      document.getElementById('expired-vouchers').classList.remove('active-section');
      
      if (section === 'active') {
        document.querySelector('.voucher-type-btn:nth-child(1)').classList.add('active');
        document.getElementById('active-vouchers').classList.add('active-section');
      } else {
        document.querySelector('.voucher-type-btn:nth-child(2)').classList.add('active');
        document.getElementById('expired-vouchers').classList.add('active-section');
      }
    }

    function endVoucher(id) {
      Swal.fire({
        title: 'End Voucher',
        text: "Are you sure you want to end this voucher?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, end it!'
      }).then((result) => {
        if (result.isConfirmed) {
          const voucherCard = document.getElementById(id);
          const expiredSection = document.getElementById('expired-vouchers');

          // Change status to Expired
          const badge = voucherCard.querySelector('.badge');
          badge.classList.remove('bg-success');
          badge.classList.add('bg-danger');
          badge.textContent = 'Expired';
          
          // Move voucher to expired section
          expiredSection.appendChild(voucherCard);
          
          // Replace buttons with Delete button
          const buttonsDiv = voucherCard.querySelector('.d-flex.justify-content-between');
          buttonsDiv.innerHTML = ''; // Clear existing buttons
          const deleteButton = document.createElement('button');
          deleteButton.className = 'btn btn-outline-primary btn-custom';
          deleteButton.textContent = 'Delete';
          deleteButton.onclick = () => deleteVoucher(id);
          buttonsDiv.appendChild(deleteButton);
          
          // Optional: Add an alert to notify the user
          Swal.fire(
            'Ended!',
            'The voucher has been marked as expired.',
            'success'
          );
        }
      });
    }

    function deleteVoucher(id) {
      Swal.fire({
        title: 'Delete Voucher',
        text: "Are you sure you want to delete this voucher?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          const voucherCard = document.getElementById(id);
          if (voucherCard) {
            voucherCard.remove(); // Remove the voucher card from the DOM
            Swal.fire(
              'Deleted!',
              'The voucher has been deleted.',
              'success'
            );
          }
        }
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
