<?php
session_start();

if (!isset($_SESSION['userID'])) {
  header('Location: index.php');
}

$userID = $_SESSION['userID'];

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


$id = $_GET["id"];

$price = $_POST["price"];
$qty = $_POST["qty"];

$amount = $price * $qty;

$sql = "INSERT INTO cart(userid, itemid, quanity, isActive)
VALUES ('" . $userID . "', " . $id . ", " . $qty . ", 0)";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
} else {
  header('Location: item.php?id=' . $id . '&error=' . $conn->error);
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'lib.php'; ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="mt-16 h-[calc(100vh-64px)] flex items-center justify-center">
    <form class="prose form-control w-full max-w-xs" method="post" action="purchase.php?Lastid=<?php echo $last_id ?>">
      <h1 class="text-center">Your Cart</h1>

      <div>
        <label for="price" class="label">
          <span class="label-text">Unit Price</span>
        </label>
        <input readonly id="price" type="text" class="input input-bordered w-full max-w-xs" name="price"
          value="<?php echo $price ?>">
      </div>

      <div class="mt-2">
        <label for="qty" class="label">
          <span class="label-text">Quantity</span>
        </label>
        <input readonly id="qty" type="text" class="input input-bordered w-full max-w-xs" name="qty"
          value="<?php echo $qty ?>">
      </div>

      <div class="mt-2">
        <label for="tot" class="label">
          <span class="label-text">Total amount</span>
        </label>
        <input readonly id="tot" type="text" class="input input-bordered w-full max-w-xs" name="tot"
          value="<?php echo $amount ?>">
      </div>

      <button type="submit" class="btn btn-outline btn-primary mt-6">Purchase</button>
    </form>
  </div>
</body>

</html>

<?php
$conn->close();
?>