<?php
session_start();
include('index.php');

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM user_do WHERE email='$email'";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            echo "<script>window.location='welcome.php';</script>";
            exit();
        }
    }
    echo "<script>alert('Invalid username or password.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>


    
</body>
</html> <div class="home-login">
        <div class="loge">
            <h1>Login</h1>
        </div>
        <div class="content">
            <form method="post">
               <div class="tex-form">
                <input type="email" placeholder="Email" name="email">
               </div>
                <div class="pass-form">
                    <input type="password" placeholder="Password" name="password">
                </div>
               
                <button type="submit" name="login">
                   Log In
                </button>
                <p>
                    Don't have an account ?
                </p>
                <h3>
                    <a href="register.php">Register</a>
                </h3>
            </form>
          
        </div>
    </div>
   