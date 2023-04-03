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

$id = intval($_GET["id"]);

// Find the existing comment of the user
$sql = "SELECT * FROM comments where item_id=" . $id . " AND username=" . "'$userID'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $rating = $result->fetch_assoc();
} else {
  $rating = null;
}

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
      <figure><img class="h-full" src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" /></figure>
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

        <?php
        if ($rating && isset($rating['rating'])) {
          $star = $rating["rating"];
        } else {
          $star = 0;
        }

        if ($rating && isset($rating['comment'])) {
          $comment = $rating['comment'];
        } else {
          $comment = "";
        }

        // create radio buttons for the rating
        $radio1 = "<input type='radio' name='rating' value='1'";
        $radio2 = "<input type='radio' name='rating' value='2'";
        $radio3 = "<input type='radio' name='rating' value='3'";
        $radio4 = "<input type='radio' name='rating' value='4'";
        $radio5 = "<input type='radio' name='rating' value='5'";

        switch ($star) {
          case 1:
            $radio1 .= " checked='checked'";
            break;
          case 2:
            $radio2 .= " checked='checked'";
            break;
          case 3:
            $radio3 .= " checked='checked'";
            break;
          case 4:
            $radio4 .= " checked='checked'";
            break;
          case 5:
            $radio5 .= " checked='checked'";
            break;
        }

        // close the radio inputs
        $radio1 .= 'class="mask mask-star-2 bg-orange-400" />';
        $radio2 .= 'class="mask mask-star-2 bg-orange-400" />';
        $radio3 .= 'class="mask mask-star-2 bg-orange-400" />';
        $radio4 .= 'class="mask mask-star-2 bg-orange-400" />';
        $radio5 .= 'class="mask mask-star-2 bg-orange-400" />';

        ?>

        <form class="form-control grow w-full mt-4" method="post" action="handle-rate.php?id=<?php echo $id ?>">
          <div class="rating">
            <?php echo $radio1; ?>
            <?php echo $radio2; ?>
            <?php echo $radio3; ?>
            <?php echo $radio4; ?>
            <?php echo $radio5; ?>
          </div>

          <div class="mt-2">
            <label for="comment" class="label">
              <span class="label-text">Comment</span>
            </label>
            <textarea id="comment" name="comment" placeholder="Writing something about the car"
              class="textarea textarea-bordered w-full"><?php echo trim($comment); ?></textarea>
          </div>

          <div class="card-actions justify-end mt-4">
            <button type="submit" class="btn btn-outline btn-primary">Rate the Car</button>
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