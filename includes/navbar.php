
<!-- <script src="css/tailwind_3_4_1_6.css"></script> -->

<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>R</b>TV</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Real-Time</b> Vote</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($voter['photo'])) ? './images/'.$voter['photo'] : './images/profile.png'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $voter['firstname'].' '.$voter['lastname']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo (!empty($voter['photo'])) ? './images/'.$voter['photo'] : './images/profile.png'; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $voter['firstname'].' '.$voter['lastname']; ?>
                <small>Registered Voter</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="profile.php" class="btn btn-default btn-flat" >Profile</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Log out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<!-- Script to toggle dropdown -->
<!-- <script>
  const menuButton = document.getElementById('menu-button');
  const dropdownMenu = document.getElementById('dropdown-menu');
  menuButton.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
  });
</script> -->








   <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

