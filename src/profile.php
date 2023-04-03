<?php
session_start();

if (isset($_GET['error'])) {
  $error = $_GET['error'];
}

$userID = $_SESSION['userID'];
$servername = "mysql_db";
$username = "root";
$password = "root";
$dbname = "hutech_php";

//connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname)
  or die("Unable to connect to MySQL");

$sql = "SELECT * FROM login WHERE username='$userID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
  exit();
} else {
  // Get the user as an associative array
  $user = mysqli_fetch_assoc($result);
  $isAdmin = $user['isAdmin'];
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Profile</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('./lib.php') ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="w-full mt-16 h-[calc(100vh-64px)] flex items-center justify-center">
    <form class="form-control w-full max-w-xs" method="post" action="update.php" enctype="multipart/form-data">
      <div class="flex items-center gap-x-2">
        <?php if (isset($user) && isset($user['avatar'])): ?>
          <div class="avatar mb-4">
            <div class="w-24 rounded-full">
              <img src="<?php echo $user['avatar'] ?>" />
            </div>
          </div>
        <?php else: ?>
          <div class="avatar placeholder mt-4">
            <div class="bg-neutral-focus text-neutral-content rounded-full w-24">
              <span class="text-3xl">
                <?php echo substr($user['username'], 0, 2) ?>
              </span>
            </div>
          </div>
        <?php endif; ?>

        <input id="avatar" type="file" type="file" class="file-input file-input-bordered file-input-xs w-full max-w-xs"
          name="avatar" accept="image/png, image/jpeg, image/jpg" />
      </div>


      <div>
        <label for="username" class="label">
          <span class="label-text">Username</span>
        </label>
        <input readonly id="username" type="text" class="input input-bordered w-full max-w-xs placeholder:italic"
          value="<?php echo $user['username'] ?>" name="username">
      </div>

      <div class="mt-2">
        <label for="password" class="label">
          <span class="label-text">Password</span>
        </label>
        <input required id="password" type="password" class="input input-bordered w-full max-w-xs placeholder:italic"
          name="password" value="<?php echo $user['password'] ?>" placeholder="Enter password...">
      </div>


      <div class="mt-2">
        <label for="address" class="label">
          <span class="label-text">Address</span>
        </label>
        <input required id="address" type="text" class="input input-bordered w-full max-w-xs placeholder:italic"
          name="address" value="<?php echo $user['address'] ?>" placeholder="Enter address...">
      </div>

      <div class="mt-2">
        <label for="telephone" class="label">
          <span class="label-text">Telephone (Format: 123-456-7890)</span>
        </label>
        <input required id="telephone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
          class="input input-bordered w-full max-w-xs placeholder:italic" name="telephone"
          value="<?php echo $user['telephone'] ?>" placeholder="Enter telephone...">
      </div>

      <div class="mt-2">
        <label for="email" class="label">
          <span class="label-text">Email</span>
        </label>
        <input required id="email" type="email" class="input input-bordered w-full max-w-xs placeholder:italic"
          value="<?php echo $user['email'] ?>" name="email" placeholder="Enter email...">
      </div>

      <button type="submit" class="btn btn-outline btn-primary mt-6">Update</button>

      <?php if (!empty($error)): ?>
        <div class="alert alert-error shadow-lg mt-6">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <?php echo "<span>Error! " . $error . "</span>" ?>
          </div>
        </div>
      <?php endif; ?>

    </form>

  </div>
</body>

</html>