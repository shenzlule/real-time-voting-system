<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-yellow sidebar-mini" style="height: 100%;    background-color: #222d32;">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header (Page header) -->
     <section class="content-header mb-6">
     
      <ol class="breadcrumb ">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Overview</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
     
    <div class="p-6 bg-gradient-to-br from-indigo-50 via-white to-indigo-100  animate-fade-in">

<!-- Dashboard Heading -->
<h2 class="text-2xl font-bold text-indigo-700  mb-6 flex items-center ">
  <i class="fas fa-tachometer-alt animate-pulse text-indigo-500"></i> Admin Dashboard
</h2>

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
<!-- Grid Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

  <!-- Voting Results -->
  <a data-toggle="modal" data-target="#selectElectionModal2" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-green-500">
    <div class="flex items-center space-x-4">
      <i class="fas fa-vote-yea text-3xl text-green-500 animate-bounce"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Voting Results</p>
        <p class="text-sm text-gray-500">Check vote tallies</p>
      </div>
    </div>
  </a>

  <!-- Votes Tally -->
  <a data-toggle="modal" data-target="#selectElectionModal" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-blue-500">
    <div class="flex items-center space-x-4">
      <i class="fas fa-chart-bar text-3xl text-blue-500 animate-wiggle"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Votes Tally</p>
        <p class="text-sm text-gray-500">Live vote count summary</p>
      </div>
    </div>
  </a>

  <!-- Manage Voters -->
  <a href="voters.php" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-purple-500">
    <div class="flex items-center space-x-4">
      <i class="fas fa-users text-3xl text-purple-600 animate-wiggle"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Manage Voters</p>
        <p class="text-sm text-gray-500">Add or edit voters</p>
      </div>
    </div>
  </a>

  <!-- Manage Positions -->
  <a href="positions.php" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-yellow-400">
    <div class="flex items-center space-x-4">
      <i class="fas fa-briefcase text-3xl text-yellow-500 animate-spin-slow"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Manage Positions</p>
        <p class="text-sm text-gray-500">Set candidate positions</p>
      </div>
    </div>
  </a>

  <!-- Manage Candidates -->
  <a href="candidates.php" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-red-500">
    <div class="flex items-center space-x-4">
      <i class="fas fa-user-tie text-3xl text-red-500 animate-pulse"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Manage Candidates</p>
        <p class="text-sm text-gray-500">View or register candidates</p>
      </div>
    </div>
  </a>

  <!-- Ballot Setup -->
  <a href="ballot.php" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-gray-500">
    <div class="flex items-center space-x-4">
      <i class="fas fa-cogs text-3xl text-gray-600 animate-spin-slow"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Ballot Setup</p>
        <p class="text-sm text-gray-500">Configure ballot design</p>
      </div>
    </div>
  </a>

  <!-- Election Configuration -->
  <a href="elections.php" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-blue-400">
    <div class="flex items-center space-x-4">
      <i class="fas fa-cogs text-3xl text-blue-500 animate-wiggle"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Election Config</p>
        <p class="text-sm text-gray-500">Manage election settings</p>
      </div>
    </div>
  </a>

  <!-- Profile Update -->
  <a href="#profile" data-toggle="modal"  id="admin_profile" class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300 hover:-translate-y-1 border-l-4 border-indigo-500">
    <div class="flex items-center space-x-4">
      <i class="fas fa-user-cog text-3xl text-indigo-600 animate-pulse"></i>
      <div>
        <p class="text-lg font-semibold text-gray-700">Profile Update</p>
        <p class="text-sm text-gray-500">Change password or info</p>
      </div>
    </div>
  </a>

</div>


<!-- Tailwind Animate.css required or your own custom animation classes -->

<div class="mt-10 px-4 sm:px-6 lg:px-8">
  <h2 class="text-xl font-bold text-gray-700 mb-6 flex items-center gap-2">
    <i class="fas fa-lightbulb text-yellow-500 animate-pulse"></i> System Insights
  </h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Positions Insight - Slide In Left -->
    <div class="rounded-xl shadow-lg bg-gradient-to-br from-cyan-500 to-blue-500 text-white p-6 transform transition-transform duration-700 animate-slideInLeft relative overflow-hidden">
      <div class="text-5xl mb-2 font-bold">
        <?php
          $sql = "SELECT * FROM positions";
          $query = $conn->query($sql);
          echo $query->num_rows;
        ?>
      </div>
      <div class="text-lg">Positions Available</div>
      <i class="fa fa-clipboard-list absolute right-4 bottom-4 text-4xl opacity-30"></i>
      <a href="positions.php" class="text-sm underline mt-3 inline-block">More info</a>
    </div>

    <!-- Candidates Insight - Bounce In -->
    <div class="rounded-xl shadow-lg bg-gradient-to-br from-green-400 to-green-600 text-white p-6 transform transition-transform duration-700 animate-bounceIn relative overflow-hidden">
      <div class="text-5xl mb-2 font-bold">
        <?php
          $sql = "SELECT * FROM candidates";
          $query = $conn->query($sql);
          echo $query->num_rows;
        ?>
      </div>
      <div class="text-lg">Registered Candidates</div>
      <i class="fa fa-user-tie absolute right-4 bottom-4 text-4xl opacity-30"></i>
      <a href="candidates.php" class="text-sm underline mt-3 inline-block">More info</a>
    </div>

    <!-- Total Voters Insight - Fade In -->
    <div class="rounded-xl shadow-lg bg-gradient-to-br from-yellow-400 to-yellow-600 text-white p-6 transform transition-transform duration-700 animate-fadeIn relative overflow-hidden">
      <div class="text-5xl mb-2 font-bold">
        <?php
          $sql = "SELECT * FROM voters";
          $query = $conn->query($sql);
          echo $query->num_rows;
        ?>
      </div>
      <div class="text-lg">Total Voters</div>
      <i class="fa fa-users absolute right-4 bottom-4 text-4xl opacity-30"></i>
      <a href="voters.php" class="text-sm underline mt-3 inline-block">More info</a>
    </div>

    <!-- Voters Voted Insight - Zoom In -->
    <div class="rounded-xl shadow-lg bg-gradient-to-br from-red-400 to-red-600 text-white p-6 transform transition-transform duration-700 animate-zoomIn relative overflow-hidden">
      <div class="text-5xl mb-2 font-bold">
        <?php
          $sql = "SELECT COUNT(DISTINCT voters_id) AS voted FROM votes";
          $query = $conn->query($sql);
          $row = $query->fetch_assoc();
          echo $row['voted'];
        ?>
      </div>
      <div class="text-lg">Voters Who Voted</div>
      <i class="fa fa-vote-yea absolute right-4 bottom-4 text-4xl opacity-30"></i>
      <a href="votes.php" class="text-sm underline mt-3 inline-block">More info</a>
    </div>

  </div>

  

</div>


</div>


<!-- Optional custom animations -->
<style>
@keyframes wiggle {
  0%, 100% { transform: rotate(-3deg); }
  50% { transform: rotate(3deg); }
}
.animate-wiggle {
  animation: wiggle 1.5s infinite;
}
.animate-spin-slow {
  animation: spin 3s linear infinite;
}
</style>



      </section>


    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
  const boxes = document.querySelectorAll('.small-box');

  function randomPulse() {
    const randomBox = boxes[Math.floor(Math.random() * boxes.length)];
    randomBox.style.transition = "transform 0.5s ease";
    randomBox.style.transform = "scale(1.08)";

    setTimeout(() => {
      randomBox.style.transform = "scale(1)";
    }, 500);

    // Call again after a random time (2 to 5 seconds)
    const randomTime = Math.floor(Math.random() * 3000) + 2000;
    setTimeout(randomPulse, randomTime);
  }

  randomPulse();
});
</script>



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

<?php include 'includes/select_election.php'; ?>


<?php include 'includes/select_election2.php'; ?>


</body>
</html>
