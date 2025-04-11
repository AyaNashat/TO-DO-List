<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: register.php");
    exit;
}
?>

<!-- <h1>Welcome
    !</h1>
<a href="to-do.php">Move to do list</a>
<a href="logout.php">Log out</a> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcoma</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>

    <div class="home-welcome">

       <form action="todo.html" method="post">
       <h1>Welcome <?php echo htmlspecialchars(explode("@", $_SESSION["email"])[0]); ?> </h1>
        <p>
            The top of one mountain is the bottom of the next So keep climping
            
        </p>
        <a href="to-do.php">Move to Do list</a><br>
        <a href="login.html">Log out</a><br><br>
       </form>
    </div>

    <style>

body{
    background-image: url("photoes/welcome.jpg");
    background-repeat: no-repeat;
    -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  background-position: center;
  
  height: 100%;
    
}

h1{
    color:#9d3920;
    font-weight:900;
}
p{
    font-weight:500;
    font-size:15px;
}
a{
    margin-top:12px;
    font-size:18px
}
    </style>
    
</body>
</html>