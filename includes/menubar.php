<aside class="main-sidebar" >
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
    <div class="flex items-center justify-center">
    <div class="div_imagee  flex justify-center items-center my-4">

  <div class="  w-[100px] h-[100px] rounded-full overflow-hidden border-2 border-gray-300 shadow bg-white p-2">
    <img 
      src="<?php echo './images/logo1.png'; ?>" 
      alt="UMU Logo" 
      class="w-full h-full object-cover"
    >
  </div>
  </div>
</div>

      <!-- <div class="pull-left info">
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div> -->
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu mt-[10px]" data-widget="tree">
     <!-- REPORTS Section -->
<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dashboard</li>

<li>
  <a href="home.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
  <i class="fas fa-tachometer-alt text-blue-600"></i> <!-- Dashboard Icon -->
    <span>Dashboard Overview</span>
  </a>
</li>


<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Vote Track</li>


<li>
  <a href="candidates.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
  <i class="fas fa-users text-green-600"></i> <!-- Candidates Icon -->
    <span>Candidates</span>
  </a>
</li>


<li>
  <a href="vote.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
  <i class="fas fa-vote-yea text-indigo-600"></i> <!-- Vote Icon -->
    <span>Vote</span>
  </a>
</li>

<!-- AI Section Header -->
<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">AI Features</li>


<li>
  <a href="voting_bot.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
  <i class="fas fa-vote-yea text-indigo-600"></i> <!-- Vote Icon -->
    <span>Ask Vote Bot</span>
  </a>
</li>


<!-- SETTINGS Section -->
<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">Settings</li>
<li>
  <a href="profile.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
  <i class="fas fa-user-circle text-yellow-600"></i> <!-- Profile Icon -->
    <span>Profile</span>
  </a>
</li>
<li>
  <a href="logout.php"  class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
  <i class="fas fa-sign-out-alt text-red-600"></i> <!-- Logout Icon -->
    <span>Logout</span>
  </a>
</li>

    </ul>
  </section>
  <!-- /.sidebar -->
  
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".sidebar-toggle");
    const logoImageBox = document.querySelector(".div_imagee");

    toggleBtn.addEventListener("click", () => {
      // Optional: check the sidebar state here if needed

      // Toggle the logo display manually or based on your condition
      if (logoImageBox.style.display === "none") {
        logoImageBox.style.display = "block";
      } else {
        logoImageBox.style.display = "none";
      }

      console.log("Sidebar toggle clicked");
    });
  });
</script>

</aside>
<?php include 'includes/config_modal.php'; ?>

