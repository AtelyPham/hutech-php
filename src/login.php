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

// Prepare the SQL statement to select the user by their username
$query = "SELECT * FROM login WHERE username = ?";

// Create a prepared statement
$stmt = $conn->prepare($query);

// Bind the username parameter to the placeholder
$stmt->bind_param("s", $user);

// Execute the SQL statement
$stmt->execute();

// Get the result of the SQL statement
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  // No user with that username
  header('location:index.php' . '?error=' . 'Username is incorrect');
  // Close the statement and the MySQLi connection
  $stmt->close();
  $conn->close();
  exit();
}

// Get the user as an associative array
$user = $result->fetch_assoc();
// Verify the password
if ($user['password'] === $pass) {
  // Password is correct
  $_SESSION['userID'] = $user['username'];
  header('location:welcome.php');
} else {
  // Password is incorrect
  header('location:index.php' . '?error=' . 'Password is incorrect');
}

// Close the statement and the MySQLi connection
$stmt->close();
$conn->close();
?>