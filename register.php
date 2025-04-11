<?php
include('index.php');

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($con, "SELECT * FROM user_do WHERE username='$username' OR email='$email'");
    
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username or email already exists.')</script>";
    } else {
        $query = "INSERT INTO user_do (username, password, email) VALUES ('$username', '$password', '$email')";
        if (mysqli_query($con, $query)) {
            
            header('Location: login.php');
            exit();
        } else {
            echo "<script>alert('Registration failed. Please try again.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

    <div class="home-register">
        <div class="register-page">
            <h1>Register</h1>
        </div>
        <div class="register-form">
            <form method="post" >
               <div class="tex-form">
                <input type="text" placeholder="User Name" name="username">
               </div>
               <div class="pass-form">
                <input type="email" placeholder="Email" name="email">
            </div>
                <div class="pass-form">
                    <input type="password" placeholder="Password" name="password">
                </div>
                
                <button type="submit" name="register">
                    Register
                </button>
                <p>
                    <a href="login.php"> Have an account ?</a>
                </p>
                
            </form>
          
        </div>
    </div>
    
</body>
</html>