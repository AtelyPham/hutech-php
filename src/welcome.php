<?php
session_start();

if (!isset($_SESSION['userID'])) {
  header('Location: index.php');
}

$userID = $_SESSION['userID'];
?>

<html>

<head>
  <title>Online Shop - Welcome</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('./lib.php') ?>
</head>


<body>
  <div>


    <?php include 'header.php'; ?>
    <?php
    //   echo 'user name :' . $_SESSION['username'];
    
    if (empty($_SESSION['username'])) {
      //    header('location:index.php');
    }


    $servername = "mysql_db";
    $username = "root";
    $password = "root";
    $dbname = "hutech_php";

    //connection to the database
    $conn = mysqli_connect($servername, $username, $password, $dbname)
      or die("Unable to connect to MySQL");

    //execute the SQL query and return records
    $result = mysqli_query($conn, "SELECT * FROM items");
    ?>

    <h1>Welcome to the Online Shop</h1>
    <h4> <br>Lets start to shopping.</h4>

    <table class="table">
      <?php
      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td> "
          . "<td> <img src=\"" . $row["image_url"] . "\" height=\"55%\" width=\"50%\"></img></td>";
        echo "<td><a href=item.php?id=" . $row["id"] . ">View More Details</td>";
        echo "</tr>";

      }
      ?>
    </table>
  </div>
</body>


</html>