<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>

<h1>RootReach</h1>   
        <p>All things food realted</p>

    <form action="query/loginform.php"  method="post">
        <input type="text" name="userName" placeholder="Mobile number or email address" required autocomplete="off"> 
        <input type="password" name="userPass" placeholder="Password" required>
        <a href="#" id="forgotPass">Forgot Password</a>
        <button name="login" type="submit">Log In</button>
    </form>

    <hr>

    <a href="">Google</a>
    <a href="">Facebook</a>

    <footer>
        <p>Don't have an account? <a href="">Sign Up</a></p>
    </footer>
</body>
</html>