
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .nav-tabs {
      margin-top: -45px; /* Adjust this value as needed */
    }
  </style>

<body>
    <?php require_once('../utilities/back_button.php'); ?>
  <div class="container my-5">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="purchasesTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="true">Completed</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="failed-tab" data-bs-toggle="tab" data-bs-target="#failed" type="button" role="tab" aria-controls="failed" aria-selected="false">Failed</button>
      </li>
    </ul>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
