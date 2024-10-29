<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Voucher</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    h4, label {
      color: #20263e;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .form-control {
      border-radius: 5px;
    }

    .btn-publish {
      background-color: #007bff; /* Bootstrap primary color */
      color: white;
      border-radius: 5px;
    }

    .btn-publish:hover {
      background-color: #0056b3; /* Darker primary color */
    }

    .section-title {
      font-weight: bold;
      margin-top: 20px;
      color: #20263e;
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-4">Create Voucher</h4>
        <form id="voucherForm">
          <div class="mb-3">
            <label for="voucherName" class="form-label">Voucher Name</label>
            <input type="text" id="voucherName" class="form-control" placeholder="Enter voucher name" required>
          </div>

          <div class="mb-3">
            <label for="discountType" class="form-label">Discount Type</label>
            <select id="discountType" class="form-control">
              <option value="percent">Percentage Off</option>
              <option value="fixed">Fixed Price Off (₱)</option>
            </select>
          </div>

          <!-- Discount Settings Section -->
          <div class="section-title">Discount Settings</div>
          <div class="mb-3">
            <label for="discountValue" class="form-label">Discount Amount</label>
            <input type="number" id="discountValue" class="form-control" placeholder="Enter discount value" required>
          </div>
          <div class="mb-3">
            <label for="minSpend" class="form-label">Minimum Spend (₱)</label>
            <input type="number" id="minSpend" class="form-control" placeholder="Enter minimum spend" required>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" id="quantity" class="form-control" placeholder="Enter quantity" required>
          </div>

          <!-- Voucher Duration Section -->
          <div class="section-title">Voucher Duration</div>
          <div class="mb-3">
            <label for="startTime" class="form-label">Start Time</label>
            <input type="date" id="startTime" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="endTime" class="form-label">End Time</label>
            <input type="date" id="endTime" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="voucherCode" class="form-label">Voucher Code</label>
            <input type="text" id="voucherCode" class="form-control" placeholder="Enter voucher code" required>
          </div>

          <button type="button" class="btn btn-publish" onclick="publishVoucher()">Publish Voucher</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function publishVoucher() {
      const voucherName = document.getElementById("voucherName").value;
      const discountType = document.getElementById("discountType").value;
      const discountValue = document.getElementById("discountValue").value;
      const minSpend = document.getElementById("minSpend").value;
      const quantity = document.getElementById("quantity").value;
      const startTime = document.getElementById("startTime").value;
      const endTime = document.getElementById("endTime").value;
      const voucherCode = document.getElementById("voucherCode").value;

      if (voucherName && discountValue && minSpend && quantity && startTime && endTime && voucherCode) {
        // Show confirmation with SweetAlert
        Swal.fire({
          title: 'Voucher Created!',
          html: `
            <p><strong>Voucher Name:</strong> ${voucherName}</p>
            <p><strong>Type:</strong> ${discountType === "percent" ? "Percentage Off" : "Fixed Price Off"}</p>
            <p><strong>Discount Amount:</strong> ${discountType === "percent" ? discountValue + "%" : "₱" + discountValue}</p>
            <p><strong>Min Spend:</strong> ₱${minSpend}</p>
            <p><strong>Quantity:</strong> ${quantity}</p>
            <p><strong>Duration:</strong> ${startTime} to ${endTime}</p>
            <p><strong>Voucher Code:</strong> ${voucherCode}</p>
          `,
          icon: 'success',
          confirmButtonText: 'OK'
        });

        // Reset the form after creating the voucher
        document.getElementById("voucherForm").reset();
      } else {
        // Show error alert if any field is missing
        Swal.fire({
          title: 'Error!',
          text: 'Please fill in all the required fields.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
