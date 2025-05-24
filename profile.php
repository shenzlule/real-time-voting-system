<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini" style="height: 100%;    background-color: #222d32;">
<div class="wrapper">
	
<?php include './includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <div class="content-wrapper">




<!-- Main content -->
<section class="content ">

<?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-10">
  <!-- Candidate Profile Section -->
  <div class="flex flex-col md:flex-row items-center md:items-start space-x-0 md:space-x-6 space-y-4 md:space-y-0">
    <div class="bg-white   p-6 max-w-md mx-auto text-center">
  <div class="w-24 h-24 mx-auto rounded-full overflow-hidden shadow-md border-4 border-blue-500 mb-4">
    <!-- <img src="<?php echo (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>" alt="profile picture" class="w-full h-full object-cover"> -->
    <img src="<?php echo (!empty($voter['photo'])) ? './images/'.$voter['photo'] : './images/profile.png'; ?>" class="w-full h-full object-cover" alt="User Image">

  </div>
  <h2 class="text-2xl font-bold text-gray-800"> <?php echo $voter['firstname'].' '.$voter['lastname']; ?></h2>
  <p class="text-md text-blue-600 font-medium mt-1">Registered Voter</p>  
 </div>
</div>


  <hr class="my-6">

  <!-- Change Password Section -->
  <div>
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Change Password</h3>
    <form class="space-y-4" method="POST" action="change_password.php" enctype="multipart/form-data" >
      <div>
        <label for="current" class="block text-gray-700 font-medium mb-1">Current Password</label>
        <input type="password" name="current"   required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>
      <div>
        <label for="new" class="block text-gray-700 font-medium mb-1">New Password</label>
        <input type="password"  name="new"  required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>
      <div>
        <label for="retype" class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
        <input type="password"  name="retype" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>
      <button type="submit" name="change" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">Update Password</button>
    </form>
  </div>
</div>


</section>


<div class="container">



</div>
</div>
  
<?php include 'includes/scripts.php'; ?>
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/ballot_modal.php'; ?>


</div>
<!-- ./wrapper -->



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


</body>
</html>
