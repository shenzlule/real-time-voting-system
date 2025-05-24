<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<?php


// Query to check if there is any election present
$sql = "SELECT COUNT(*) as total FROM elections";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    // No election found, redirect to overview page
    header('Location: overview.php');
    exit();
}

// If election exists, continue normal processing here...
?>


<body class="hold-transition skin-yellow sidebar-mini"  style="height: 100%;    background-color: #222d32;">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vote Results
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Candidates</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
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
     

      <div class="row mb-4">
        <div class="col-xs-12">
          <h3>Voting Results
         
          </h3>
        </div>
      </div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
<div id="leader-summary" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 p-4">
<?php
$sql = "SELECT * FROM positions ORDER BY priority ASC";
$query = $conn->query($sql);

while ($row = $query->fetch_assoc()) {
    $positionId = $row['id'];
    $positionTitle = htmlspecialchars($row['description']);

    // Fetch top candidate by vote count
    $topSql = "
        SELECT c.lastname, c.firstname, COUNT(v.id) as total_votes
        FROM candidates c
        LEFT JOIN votes v ON c.id = v.candidate_id
        WHERE c.position_id = '$positionId'
        GROUP BY c.id
        ORDER BY total_votes DESC
        LIMIT 1";
    $topQuery = $conn->query($topSql);

    if ($topQuery->num_rows == 0) continue;

    $top = $topQuery->fetch_assoc();
    $fullName = htmlspecialchars($top['firstname'] . ' ' . $top['lastname']);
    $votes = $top['total_votes'];

    echo <<<HTML
    <div class="bg-white rounded-2xl shadow-lg border border-blue-200 p-6 transform transition duration-500 hover:scale-105 animate-fade-in-up">
        <h3 class="text-lg font-semibold text-blue-700 mb-2">$positionTitle</h3>
        <div class="text-2xl font-bold text-gray-800">$fullName</div>
        <p class="text-sm text-gray-500">Leading with <span class="text-blue-600 font-medium">$votes votes</span></p>
        <div class="mt-4 w-full bg-gray-200 rounded-full h-3">
            <div class="bg-blue-500 h-3 rounded-full animate-pulse" style="width: 100%"></div>
        </div>
    </div>
HTML;
}
?>
</div>




      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

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
