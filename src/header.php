<?php
if (!empty($userID) && isset($conn) && !isset($user)) {
  $sql = "SELECT * FROM login WHERE username='$userID'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 0) {
    // Result is empty
    exit();
  } else {
    // Get the user as an associative array
    $user = mysqli_fetch_assoc($result);
    $isAdmin = $user['isAdmin'];
  }
} else {
  // User is not logged in
}
?>

<header class="navbar fixed z-10 top-0 bg-base-100">
  <div class="flex-1">
    <div class="flex">
      <img src="assets/car.svg" alt="Car" class="w-10 h-10" />
      <a href="index.php" class="btn btn-ghost normal-case text-xl">TTK Car Shop</a>
    </div>
  </div>
  <?php if (!empty($userID)): ?>
    <div class="flex-none">
      <div class="dropdown dropdown-end">
        <div class="indicator">
          <?php if ($isAdmin): ?>
            <span class="indicator-item indicator-bottom indicator-start badge badge-accent">AD</span>
          <?php endif; ?>
          <?php
          $has_avatar = isset($user) && isset($user['avatar']);
          $base_clxs = "btn btn-ghost btn-circle avatar";

          // Set the class name based on the condition
          if ($has_avatar) {
            $class_name = $base_clxs;
          } else {
            $class_name = $base_clxs . " placeholder";
          }
          ?>

          <label tabindex="0" class="<?php echo $class_name; ?>">
            <?php if ($has_avatar): ?>
              <div class="w-10 rounded-full">
                <?php echo '<img src="/' . $user['avatar'] . '">'; ?>
              </div>
            <?php else: ?>
              <div class="bg-neutral-focus text-neutral-content rounded-full w-10">
                <?php echo '<span class="text-xl">' . substr($user['username'], 0, 2) . '</span>'; ?>
              </div>
            <?php endif; ?>
          </label>
        </div>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow-xl bg-base-100 rounded-box w-52">
          <li class="px-4 py-2 italic">
            Hello
            <?php echo $user['username']; ?>
          </li>
          <li>
            <a href="profile.php" class="justify-between">
              Profile
              <span class="badge">New</span>
            </a>
          </li>
          <li><a href="?clear_session=true">Logout</a></li>
        </ul>
      </div>
    </div>
  <?php else: ?>
    <a href="index.php" class='btn btn-primary'>Login</a>
  <?php endif; ?>

  <select data-choose-theme class="select select-bordered ml-4">
    <?php
    $themes = ["light", "dark", "cupcake", "bumblebee", "emerald", "corporate", "synthwave", "retro", "cyberpunk", "valentine", "halloween", "garden", "forest", "aqua", "lofi", "pastel", "fantasy", "wireframe", "black", "luxury", "dracula", "cmyk", "autumn", "business", "acid", "lemonade", "night", "coffee", "winter"];
    foreach ($themes as $theme) {
      if ($theme == "dark")
        echo "<option value='$theme' selected>" . ucfirst($theme) . "</option>";
      else
        echo "<option value='$theme'>" . ucfirst($theme) . "</option>";
    }
    ?>
  </select>
</header>