<?php
session_start();

if (isset($_GET['clear_session'])) {
  session_unset(); // Unset all session variables
  session_destroy(); // Destroy the session
  header("Location: index.php"); // Redirect the user to the homepage (replace with your desired URL)
  exit(); // Stop executing the script
}

if (!isset($_SESSION['userID'])) {
  header('Location: index.php');
}

$userID = $_SESSION['userID'];

$servername = "mysql_db";
$username = "root";
$password = "root";
$dbname = "hutech_php";

//connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname)
  or die("Unable to connect to MySQL");
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

    <div class="mt-16 p-6">
      <?php
      //execute the SQL query and return records
      $result = mysqli_query($conn, "SELECT * FROM items");
      ?>

      <div class="prose">
        <h1>Welcome to the Online Shop</h1>
        <h3>Lets start to shopping.</h3>
      </div>

      <div class="mt-4 grid grid-cols-3 gap-4">
        <?php
        // Iterate through the rows using mysqli_fetch_array
        while ($row = mysqli_fetch_array($result)) {
          ?>
          <div class="min-w-0 w-full">
            <div class="card bg-base-100 min-w-96 shadow-xl">
              <figure><img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" /></figure>
              <div class="card-body">
                <h2 class="card-title">
                  <?php echo $row['name']; ?>
                  <div class="badge badge-secondary">
                    <?php echo $row['unit_price']; ?>
                  </div>
                </h2>
                <p>
                  <?php echo $row['description']; ?>
                </p>
                <div class="card-actions justify-end">
                  <a href="<?php echo 'item.php?id=' . $row['id'] ?>" class="btn btn-primary">More detail</a>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</body>


</html>

<?php
//close the connection
mysqli_close($conn);
?>