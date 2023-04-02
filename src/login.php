<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['username'];
  $pass = $_POST['password'];
}


$servername = "mysql_db";
$username = "root";
$password = "root";
$dbname = "hutech_php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username,password FROM login";
$result = $conn->query($sql);

static $x = 0;
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    // echo "id: " . $row["username"]. " - Name: " . $row["password"]. "<br>";
    if ($row["username"] == $user && $row["password"] == $pass) {
      //echo 'Welcome to the DeepWeb';
      $x++;
      $userID = $row["username"];
    } else {
      //echo "try again Bro";
    }
  }
  if ($x > 0) {
    $_SESSION['userID'] = $userID;
    header('location:welcome.php');
  } else {
    $error = "Username or Password is incorrect";
    header('location:index.php' . '?error=' . $error);
  }
} else {
  $error = "Not found";
  header('location:index.php' . '?error=' . $error);
}
$conn->close();
?>