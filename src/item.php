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

// Calculate the average rating
$sql = "SELECT AVG(rating) AS avg_rating FROM comments WHERE item_id = " . $id;
$result = $conn->query($sql);
$avg_rating = $result->fetch_assoc()['avg_rating'];
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
      <figure><img class="h-full" src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" /></figure>
      <div class="card-body">
        <h2 class="card-title">
          <?php echo $item['name']; ?>
          <span class="badge badge-secondary">
            $
            <?php echo $item['unit_price']; ?>
          </span>

          <?php
          // create radio buttons for the rating
          $radio1 = "<input type='radio' name='rating' value='1'";
          $radio2 = "<input type='radio' name='rating' value='2'";
          $radio3 = "<input type='radio' name='rating' value='3'";
          $radio4 = "<input type='radio' name='rating' value='4'";
          $radio5 = "<input type='radio' name='rating' value='5'";

          // Checked based on the average rating
          if ($avg_rating <= 1) {
            $radio1 .= " checked='checked'";
          } else if ($avg_rating <= 2) {
            $radio2 .= " checked='checked'";
          } else if ($avg_rating <= 3) {
            $radio3 .= " checked='checked'";
          } else if ($avg_rating <= 4) {
            $radio4 .= " checked='checked'";
          } else {
            $radio5 .= " checked='checked'";
          }

          $radio1 .= " disabled='disabled' class='mask mask-star-2 bg-orange-400' />";
          $radio2 .= " disabled='disabled' class='mask mask-star-2 bg-orange-400' />";
          $radio3 .= " disabled='disabled' class='mask mask-star-2 bg-orange-400' />";
          $radio4 .= " disabled='disabled' class='mask mask-star-2 bg-orange-400' />";
          $radio5 .= " disabled='disabled' class='mask mask-star-2 bg-orange-400' />";
          ?>

          <?php if ($avg_rating > 0) { ?>
            <div class="rating rating-sm">
              <?php echo $radio1; ?>
              <?php echo $radio2; ?>
              <?php echo $radio3; ?>
              <?php echo $radio4; ?>
              <?php echo $radio5; ?>
            </div>
          <?php } ?>
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

          <div class="card-actions justify-end mt-4">
            <a href="<?php echo 'rate.php?id=' . $item['id'] ?>" class="btn btn-outline btn-secondary">Rate the Car</a>
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