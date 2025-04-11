<?php
//  session_start();
// include 'index.php'; 

//  if (!isset($_SESSION["user_id"])) {
//      header("Location: login.php");
//     exit;
// }

// $user_id = $_SESSION["user_id"];


// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
//     $task = trim($_POST["task"]);
//     if (!empty($task)) {
//         $stmt = $connection->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
//         $stmt->bind_param("is", $user_id, $task);
//         $stmt->execute();
//     }
//     header("Location: todo.php"); 
//     exit;
// }


// if (isset($_GET["delete"])) {
//     $task_id = intval($_GET["delete"]);
//     $stmt = $connection->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
//     $stmt->bind_param("ii", $task_id, $user_id);
//     $stmt->execute();
//     header("Location: to-do.php"); 
//     exit;
// }


// $stmt = $connection->prepare("SELECT id, task FROM tasks WHERE user_id = ?");
// $stmt->bind_param("i", $user_id);
// $stmt->execute();
// $result = $stmt->get_result();
// if (!$result) {
//     die("خطأ في جلب البيانات: " . $connection->error);
// }
// else {
// die("خطأ في تحضير الاستعلام: " . $connection->error);
// }






// $db=mysqli_connect('localhost','root','','aya');
// if(isset($_POST['sumbit'])){
//     $task=$_POST['task'];

//     mysqli_query($db,"INSERT INTO tasks (task) VALUES ('$task')");
//     header('location: todo.php');
// }



// $task=$_POST["task"];
// $connection = new mysqli ('localhost','root','','aya');
// $stmt=$connection->prepare("INSERT INTO tasks (user_id,task) VALUES (?,?)");
// $stmt->bind_param("is",$user_id,$task);
// $stmt->execute();
// echo"done";




session_start();
include 'index.php'; // Ensure this file contains $connection

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Add task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
    $task = trim($_POST["task"]);
    if (!empty($task)) {
        $stmt = $con->prepare("INSERT INTO tasks (user_id, task, completed) VALUES (?, ?, 0)");
        if (!$stmt) {
            die("Error preparing insert statement: " . $con->error);
        }
        $stmt->bind_param("is", $user_id, $task);
        if (!$stmt->execute()) {
            die("Error executing insert query: " . $stmt->error);
        }
    }
}

// Mark task as completed
if (isset($_GET["complete"])) {
    $task_id = intval($_GET["complete"]);
    $stmt = $con->prepare("UPDATE tasks SET completed = NOT completed WHERE id = ? AND user_id = ?");
    if (!$stmt) {
        die("Error preparing update statement: " . $con->error);
    }
    $stmt->bind_param("ii", $task_id, $user_id);
    if (!$stmt->execute()) {
        die("Error executing update query: " . $stmt->error);
    }
}

// Delete task
if (isset($_GET["delete"])) {
    $task_id = intval($_GET["delete"]);
    $stmt = $con->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    if (!$stmt) {
        die("Error preparing delete statement: " . $con->error);
    }
    $stmt->bind_param("ii", $task_id, $user_id);
    if (!$stmt->execute()) {
        die("Error executing delete query: " . $stmt->error);
    }
}

// Fetch tasks
$stmt = $con->prepare("SELECT id, task, completed FROM tasks WHERE user_id = ?");
if (!$stmt) {
    die("Error preparing select statement: " . $con->error);
}
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Error executing select query: " . $stmt->error);
}

$result = $stmt->get_result();
if (!$result) {
    die("Error getting result: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="to-do.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

   <h1 class="to-do-home">To Do List</h1>
   <div class="con-do">
    <form method="POST" class="fal">
        <input type="text" name="task" placeholder="Add New Task" required style="margin-top:10px;">
        <button type="submit" style="border: none;">
            <i class="fa-solid fa-plus" style="font-size: 15px;"></i>
        </button>
    </form>

    <table >
        
        <tbody style="margin-right=45px;">
         <?php while ($row = $result->fetch_assoc()): ?>
             <tr class="<?= $row['completed'] ? 'completed' : '' ?>">
                 <td>
                     <input type="checkbox" class="set" onchange="window.location.href='to-do.php?complete=<?= $row['id'] ?>'" <?= $row['completed'] ? 'checked' : '' ?>>
                 </td>
                 <td>
                     <span><?php echo htmlspecialchars($row["task"]); ?></span>
                 </td>
                 <td>
                     <a href="to-do.php?delete=<?php echo $row["id"]; ?>" style="color:red; ">
                         <i class="fa-solid fa-xmark "></i>
                     </a>
                 </td>
             </tr>
         <?php endwhile; ?>
        </tbody>
    </table>

    <a href="logout.php "> Log Out</a>
   
   </div>
  
  

   <style>
       .completed span {
           text-decoration: line-through;
           color: black;
       }
       a{
        text-decoration: none;
        margin-top:25px;
        color:#990808;
        font-weight:700;
        font-size:18px;
       }
       li{
        text-decoration: none;
       }
       .con-do i{
  font-size: 15px;
  color:#990808;

  
}

h1{
    
    
    text-align: center;
    justify-content: center;
    width: 40%;
    margin: auto;
    padding-top: 10px;
    padding-bottom: 20px;
    position: relative;
    top: 150px;
    color:#990808;
}
.set input{
    margin-right:5px;
    accent-color:#990808;
}

.fal input{
    padding:5px 8px 5px 8px;
    border-radius:8px;
    text-align:center;
    margin-bottom:12px;
    margin-right:8px;
}
 button{
  border: transparent;
  background-color:transparent;
}

.con-do input{
  border: none;
}
ul {
  list-style-type: none;
}
li {
  list-style-type: none;
}
body
{
    background-image: url("photoes/do.jpg");
    background-repeat: no-repeat;
    -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  background-position: center;
  
  height: 100vh;
}
.sd{
    
    text-align: center;
    justify-content: center;
    width: 40%;
   /* // margin: auto; */
    padding-top: 10px;
    padding-bottom: 20px;
    position: relative;
    top: 150px;
}

   </style>

</body>
</html>
