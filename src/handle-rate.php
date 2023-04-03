<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $rating = intval($_POST['rating']);
  $comment = $_POST['comment'];
}

$userID = $_SESSION['userID'];
$id = intval($_GET["id"]);

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

$sql = "SELECT * FROM login WHERE username='$userID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
  // Result is empty
  exit();
} else {
  // Get the user as an associative array
  $user = mysqli_fetch_assoc($result);
}

// Prepare the SQL statement to select the user by their username
$query = "SELECT * FROM comments WHERE username = ? AND item_id = ?";

// Create a prepared statement
$stmt = $conn->prepare($query);

// Bind the username parameter to the placeholder
$stmt->bind_param("si", $user['username'], $id);

// Execute the SQL statement
$stmt->execute();

// Get the result of the SQL statement
$result = $stmt->get_result();

// If the result is empty, the comment does not exist
if ($result->num_rows === 0) {
  // Prepare the SQL statement to insert the comment
  $query = "INSERT INTO comments (username, item_id, rating, comment) VALUES (?, ?, ?, ?)";

  // Create a prepared statement
  $stmt = $conn->prepare($query);

  // Bind the parameters to the placeholders
  $stmt->bind_param("siis", $user['username'], $id, $rating, $comment);

  // Execute the SQL statement
  $stmt->execute();
} else {
  // Prepare the SQL statement to update the comment
  $query = "UPDATE comments SET rating = ?, comment = ? WHERE username = ? AND item_id = ?";

  // Create a prepared statement
  $stmt = $conn->prepare($query);

  // Bind the parameters to the placeholders
  $stmt->bind_param("issi", $rating, $comment, $user['username'], $id);

  // Execute the SQL statement
  $stmt->execute();
}

// Redirect to the item page
header('Location: item.php?id=' . $id);

// Close the statement and the MySQLi connection
$stmt->close();
$conn->close();
?>