<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <title>Login Page</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 14px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
        }

        .heading {
            color: #333;
            font-family: Inter, sans-serif;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .subheading {
            color: #666;
            font-family: Inter, sans-serif;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .input-container {
            margin-bottom: 20px;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            height: 50px;
            background: #f6f6f6;
            border-radius: 5px;
            border: none;
            padding: 0 15px;
            font-size: 14px;
            margin-bottom: 5px;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #999;
        }

        .forgot-password {
            font-size: 12px;
            color: #5783DB;
            cursor: pointer;
            text-decoration: underline;
            margin-top: 10px;
            display: block;
            text-align: right;
        }

        .login-button {
            width: 100%;
            height: 40px;
            background: #5783DB;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.5s ease; 
        }

        .login-button:hover {
            background-color: #5BBCFF; 
        }

        hr {
            margin: 20px 0;
            border: 0.5px solid rgba(0, 0, 0, 0.1);
        }

        .external-links {
            margin-bottom: 20px;
        }

        .external-links img {
            width: 24px;
            height: 24px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .external-links a {
            display: inline-block;
            height: 30px;
            background: #f6f6f6;
            border-radius: 5px;
            text-align: center;
            line-height: 30px;
            color: #333;
            text-decoration: none;
            margin: 0 12px;
            font-size: 14px;
        }

        .signup-link {
            color: #333;
            font-size: 12px;
            cursor: pointer;
        }

        .signup-link a {
            text-decoration: underline;
            color: #5783DB;
        }

        .checkbox-container {
            text-align: left;
            margin-top: 10px;
        }

        .checkbox-container input[type="checkbox"] {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="heading">RootReach</h1>
        <p class="subheading">All things food related</p>

        <form action="#" method="post">
            <div class="input-container">
                <input type="text" name="userName" placeholder="Mobile number or email address" required>
            </div>

            <div class="input-container">
                <input type="password" name="userPass" id="password" placeholder="Password" required>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" onclick="togglePassword()"> Show Password
            </div>

            <a href="#" class="forgot-password">Forgot Password?</a>

            <button type="submit" class="login-button">Log In</button>
        </form>

        <hr>

        <div class="external-links">
            <a href="#"><img src="https://static-00.iconduck.com/assets.00/google-icon-2048x2048-czn3g8x8.png" alt="Google Logo"></a>
            <a href="#"><img src="https://static.vecteezy.com/system/resources/previews/023/986/613/non_2x/facebook-logo-facebook-logo-transparent-facebook-icon-transparent-free-free-png.png" alt="Facebook Logo"></a>
        </div>

        <div class="signup-link">Don't have an account? <a href="#">Sign Up</a></div>
    </div>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>
