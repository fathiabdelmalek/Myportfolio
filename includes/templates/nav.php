<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Boards</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Portfolios</a>
        </li>
      </ul>
      <span class="navbar-text">
        <?php if(isset($_SESSION['user'])) { ?>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $_SESSION['user'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        <?php } else {?>
          <a class="text-primary" href=""> Login </a> | <a class="text-primary" href="">Register</a>
        <?php } ?>
      </span>
    </div>
  </div>
</nav>
