<?php

if (isset($_GET['error'])) {
  $error = $_GET['error'];
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Register</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('./lib.php') ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="w-full mt-16 flex items-center justify-center">
    <form class="prose form-control w-full max-w-xs" method="post" action="save.php" enctype="multipart/form-data">
      <h1 class="text-center">Register</h1>

      <div>
        <label for="username" class="label">
          <span class="label-text">Username</span>
        </label>
        <input required id="username" type="text" class="input input-bordered w-full max-w-xs placeholder:italic"
          placeholder="Enter username..." name="username">
      </div>

      <div class="mt-2">
        <label for="password" class="label">
          <span class="label-text">Password</span>
        </label>
        <input required id="password" type="password" class="input input-bordered w-full max-w-xs placeholder:italic"
          name="password" placeholder="Enter password...">
      </div>


      <div class="mt-2">
        <label for="address" class="label">
          <span class="label-text">Address</span>
        </label>
        <input required id="address" type="text" class="input input-bordered w-full max-w-xs placeholder:italic"
          name="address" placeholder="Enter address...">
      </div>

      <div class="mt-2">
        <label for="telephone" class="label">
          <span class="label-text">Telephone (Format: 123-456-7890)</span>
        </label>
        <input required id="telephone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
          class="input input-bordered w-full max-w-xs placeholder:italic" name="telephone"
          placeholder="Enter telephone...">
      </div>

      <div class="mt-2">
        <label for="email" class="label">
          <span class="label-text">Email</span>
        </label>
        <input required id="email" type="email" class="input input-bordered w-full max-w-xs placeholder:italic"
          name="email" placeholder="Enter email...">
      </div>

      <div class="mt-2">
        <label for="avatar" class="label">
          <span class="label-text">Avatar (Optional)</span>
        </label>
        <input id="avatar" type="file" class="file-input file-input-bordered w-full max-w-xs" name="avatar"
          accept="image/png, image/jpeg, image/jpg" />
      </div>

      <button type="submit" class="btn btn-outline btn-primary mt-6">Register</button>

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