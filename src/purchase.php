<?php
session_start();

if (!isset($_SESSION['userID'])) {
  header('Location: index.php');
}

$userID = $_SESSION['userID'];

$idLast = $_GET["Lastid"];


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

$sql = "UPDATE cart SET isActive=1 WHERE id=$idLast";

if ($conn->query($sql) === TRUE) {
  header('location:welcome.php');
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>