<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $add = $_POST['address'];
  $tele = $_POST['telephone'];
  $email = $_POST['email'];
}



$servername = "mysql_db";
$username = "root";
$password = "root";
$dbname = "hutech_php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// The error message 
$error = '';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Find the user by username in the database
$query = mysqli_query($conn, "SELECT * FROM login WHERE username='$user'");
if (mysqli_num_rows($query) === 0) {
  header('location:profile.php' . '?error=' . "Username not found");
  exit();
}

$target_file = '';

// If file is included in the post request
if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["avatar"]["name"]);

  // Check if file already exists
  if (file_exists($target_file)) {
    $error = "Sorry, file already exists.";
  } else if ($_FILES["avatar"]["size"] > 500000) { // Check file size
    $error = "Sorry, your file is too large.";
  } else { // Upload file
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
      // Upload file success
    } else {
      $error = "Sorry, there was an error uploading your file.";
    }
  }
}

if (!empty($error)) {
  header('location:register.php' . '?error=' . $error);
  exit();
}

// Update the user
if (empty($target_file)) {
  $sql = "UPDATE login SET password='$pass', address='$add', telephone='$tele', email='$email' WHERE username='$user'";
} else {
  $sql = "UPDATE login SET password='$pass', address='$add', telephone='$tele', email='$email', avatar='$target_file' WHERE username='$user'";
}

if ($conn->query($sql) === TRUE) {
  header('location:welcome.php');
} else {
  header('location:profile.php' . '?error=' . $conn->error);
}

$conn->close();
?>