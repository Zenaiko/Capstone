<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Login</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h4 class="form-title">Login</h4>
        <form action="../db_api/db_login_rider.php" method="POST" id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Username/Phone Number</label>
                <input type="text" class="form-control" name="credentials" id="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="pswd" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>
        <div class="footer">
            <p>Don't have an account? <a href="../number_otp.php?user=rider">Sign Up</a></p>
            <p><a href="">Forgot Password?</a></p>
        </div>
    </div>
</body>
<?php
if (isset($_SESSION['form_success'])) {
    if ($_SESSION['form_success'] === "success") {
        echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Rider Application Submitted',
            text: 'Your rider request is under review, please check back shortly',
        });
        </script>";
    } elseif ($_SESSION['form_success'] === "error") {
        echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'An error has occured when creating you account',
            text: 'Please try again',
        </script>";
    }

    // Unset the session variable after displaying it
    unset($_SESSION['form_success']);
}
?>
</html>
