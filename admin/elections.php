<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini" style="height: 100%;    background-color: #222d32;">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Elections 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">elections</li>
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
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <div class="card-tools">
        <?php
// Check if any election exists
$electionExists = false;
$sql = "SELECT id FROM elections LIMIT 1";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $electionExists = true;
}
?>

<!-- Later in your HTML where the button is -->

<?php if (!$electionExists): ?>
    <a class="btn btn-success btn-sm" data-toggle="modal" href="#addElectionModal">
        <i class="fas fa-plus"></i> Add Election
    </a>
<?php endif; ?>

        </div>
      </div>


      <div class="row mt-3">
        <div class="col-xs-12">
          <div class="box p-4">
      <div class="card-body  table-responsive">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Election Name</th>
              <th>Date</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Status</th>
              <th>Created On</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Replace this with your real DB fetch logic
              $query = mysqli_query($conn, "SELECT * FROM elections");
              while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['election_name']}</td>
                  <td>{$row['election_date']}</td>
                  <td>{$row['start_time']}</td>
                  <td>{$row['end_time']}</td>
                  <td><span class='badge badge-" . ($row['status'] == 'ongoing' ? 'warning' : ($row['status'] == 'completed' ? 'secondary' : 'info')) . "'>{$row['status']}</span></td>
                  <td>{$row['created_on']}</td>
                  <td>
                  <a class='btn btn-info btn-sm editElection' href='#editElectionModal' data-id='".$row['id']."'>
                  <i class='fas fa-edit'></i> Edit
              </a>
                                 
                  </td>
                </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
      </div>
      </div>
      </div>


    </div>
  </div>
</section>

  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/votes_modal.php'; ?>
  <?php include 'includes/election_Modal.php'; ?>

</div>
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


<script>
$(function(){
  $(document).on('click', '.editElection', function(e){
    e.preventDefault();
    $('#editElectionModal').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });



  $(document).on('click', '.deleteElection', function(e){
    e.preventDefault();
    $('#deleteElection').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


  
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'elections_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edit_election_id').val(response.id);
      $('#edit_election_name').val(response.election_name);
      $('#edit_election_date').val(response.election_date);
      $('#edit_start_time').val(response.start_time);
      $('#edit_end_time').val(response.end_time);
      $('#edit_status').val(response.status);
      $('.fullname').html(response.election_name);
      $('#edit_election_id_del').val(response.id);
      $('#edit_release_results').val(response.release_results);
      $('#edit_release_voting_guide').val(response.release_voting_guide);

    }
  });
}
</script>
</body>
</html>
