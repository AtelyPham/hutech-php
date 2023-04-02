<?php

if (isset($_GET['error'])) {
  $error = $_GET['error'];
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Online Shop - Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('./lib.php') ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="w-full h-screen flex items-center justify-center">
    <form class="prose form-control w-full max-w-xs" method="post" action="login.php">
      <h1 class="text-center">Login</h1>

      <div>
        <label class="label">
          <span class="label-text">Username</span>
        </label>
        <input required id="email" type="text" class="input input-bordered w-full max-w-xs placeholder:italic"
          placeholder="Username..." name="username">
      </div>

      <div class="mt-2">
        <label class="label">
          <span class="label-text">Password</span>
        </label>
        <input required id="password" type="password" class="input input-bordered w-full max-w-xs placeholder:italic"
          name="password" placeholder="Password...">
      </div>

      <button type="submit" class="btn btn-outline btn-primary mt-6">Login</button>

      <span class="not-prose block mt-1">Not Registered yet? <a class="btn-link" href="register.php"> Click
          Here</a></span>

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