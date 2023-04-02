<?php
session_start();

if (!isset($_SESSION['userID'])) {
  header('Location: index.php');
}

$servername = "mysql_db";
$username = "root";
$password = "root";
$dbname = "hutech_php";

//connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname)
  or die("Unable to connect to MySQL");


$userID = $_SESSION['userID'];

$id = $_GET["id"];

//execute the SQL query and return records
$sql = "SELECT * FROM items where id=" . $id;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $item = $result->fetch_assoc();
} else {
  header('Location: welcome.php');
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>
    <?php echo $item['name']; ?>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('./lib.php'); ?>
</head>

<body>
  <?php require_once('header.php'); ?>

  <div class="mt-16 h-[calc(100vh-64px)] flex items-center justify-center">
    <div class="card lg:card-side bg-base-100 shadow-xl">
      <figure><img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" /></figure>
      <div class="card-body">
        <h2 class="card-title">
          <?php echo $item['name']; ?>
          <span class="badge badge-secondary">
            $
            <?php echo $item['unit_price']; ?>
          </span>
        </h2>

        <div>
          <p>
            <?php echo $item['description']; ?>
          </p>
        </div>

        <form class="form-control grow w-full mt-4" method="post" action="cart.php?id=<?php echo $id ?>">
          <div class="">
            <label for="price" class="label">
              <span class="label-text">Unit price</span>
            </label>
            <input name="price" id="price" value="<?php echo $item['unit_price'] ?>" readonly type="text"
              class="input input-bordered w-full" />
          </div>

          <div class="mt-2">
            <label for="qty" class="label">
              <span class="label-text">Unit price</span>
            </label>
            <input name="qty" id="qty" type="text" placeholder="Enter quantity"
              class="input input-bordered w-full placeholder:italic" required inputmode="numeric" pattern="[0-9]*" />
          </div>

          <div class="card-actions justify-end mt-auto">
            <button type="submit" class="btn btn-outline btn-primary">Add to Cart</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

<?php
$conn->close();
?>