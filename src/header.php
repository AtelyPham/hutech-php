<header class="navbar fixed top-0 bg-base-100">
  <div class="flex-1">
    <div class="flex">
      <img src="assets/car.svg" alt="Car" class="w-10 h-10" />
      <a href="index.php" class="btn btn-ghost normal-case text-xl">TTK Car Shop</a>
    </div>
  </div>
  <?php if (!empty($userID)): ?>
    <div class="flex-none">
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="/images/stock/photo-1534528741775-53994a69daeb.jpg" />
          </div>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
          <li>
            <a class="justify-between">
              Profile
              <span class="badge">New</span>
            </a>
          </li>
          <li><a>Logout</a></li>
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