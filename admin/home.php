<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      </h1>
    
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
  <!-- Positions Box -->
  <div class="col-lg-3 col-xs-6">
    <!-- Small Box -->
    <div class="small-box bg-gradient-to-r from-cyan-500 to-blue-500 hover:scale-105 transition-transform duration-300 rounded-lg shadow-lg">
      <div class="inner p-6">
        <?php
          $sql = "SELECT * FROM positions";
          $query = $conn->query($sql);
          echo "<h3 class='text-4xl font-semibold'>".$query->num_rows."</h3>";
        ?>
        <p class="text-lg">No. of Positions</p>
      </div>
      <div class="icon text-white">
        <i class="fa fa-clipboard-list"></i>
      </div>
      <a href="positions.php" class="small-box-footer text-white bg-opacity-70 hover:bg-opacity-100 transition-all duration-300">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Candidates Box -->
  <div class="col-lg-3 col-xs-6">
    <!-- Small Box -->
    <div class="small-box bg-gradient-to-r from-green-400 to-green-600 hover:scale-105 transition-transform duration-300 rounded-lg shadow-lg">
      <div class="inner p-6">
        <?php
          $sql = "SELECT * FROM candidates";
          $query = $conn->query($sql);
          echo "<h3 class='text-4xl font-semibold'>".$query->num_rows."</h3>";
        ?>
        <p class="text-lg">No. of Candidates</p>
      </div>
      <div class="icon text-white">
        <i class="fa fa-user-tie"></i>
      </div>
      <a href="candidates.php" class="small-box-footer text-white bg-opacity-70 hover:bg-opacity-100 transition-all duration-300">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Voters Box -->
  <div class="col-lg-3 col-xs-6">
    <!-- Small Box -->
    <div class="small-box bg-gradient-to-r from-yellow-400 to-yellow-600 hover:scale-105 transition-transform duration-300 rounded-lg shadow-lg">
      <div class="inner p-6">
        <?php
          $sql = "SELECT * FROM voters";
          $query = $conn->query($sql);
          echo "<h3 class='text-4xl font-semibold'>".$query->num_rows."</h3>";
        ?>
        <p class="text-lg">Total Voters</p>
      </div>
      <div class="icon text-white">
        <i class="fa fa-users"></i>
      </div>
      <a href="voters.php" class="small-box-footer text-white bg-opacity-70 hover:bg-opacity-100 transition-all duration-300">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Voters Voted Box -->
  <div class="col-lg-3 col-xs-6">
    <!-- Small Box -->
    <div class="small-box bg-gradient-to-r from-red-400 to-red-600 hover:scale-105 transition-transform duration-300 rounded-lg shadow-lg">
      <div class="inner p-6">
        <?php
          $sql = "SELECT * FROM votes GROUP BY voters_id";
          $query = $conn->query($sql);
          echo "<h3 class='text-4xl font-semibold'>".$query->num_rows."</h3>";
        ?>
        <p class="text-lg">Voters Voted</p>
      </div>
      <div class="icon text-white">
        <i class="fa fa-vote-yea"></i>
      </div>
      <a href="votes.php" class="small-box-footer text-white bg-opacity-70 hover:bg-opacity-100 transition-all duration-300">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

      <div class="row">
        <div class="col-xs-12">
          <h3>Votes Tally
            <span class="pull-right">
              <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
            </span>
          </h3>
        </div>
      </div>

      <?php
        $sql = "SELECT * FROM positions ORDER BY priority ASC";
        $query = $conn->query($sql);
        $inc = 2;
        while($row = $query->fetch_assoc()){
          $inc = ($inc == 2) ? 1 : $inc+1; 
          if ($inc == 1) echo "<div class='flex flex-wrap -mx-4'>";
echo "
  <div class='w-full md:w-1/2 p-4'>
    <div class='bg-white rounded-2xl shadow-lg border border-gray-200'>
      <div class='bg-gradient-to-r from-blue-500 to-indigo-600 rounded-t-2xl px-6 py-4'>
        <h4 class='text-white text-lg font-semibold tracking-wide'>
          <b>{$row['description']}</b>
        </h4>
      </div>
      <div class='p-6'>
        <div class='chart'>
          <canvas id='".slugify($row['description'])."' style='height: 200px;'></canvas>
        </div>
      </div>
    </div>
  </div>
";


          
          if($inc == 2) echo "</div>";  
        }
        if($inc == 1) echo "<div class='col-sm-6'></div></div>";
      ?>

      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<?php
  $sql = "SELECT * FROM positions ORDER BY priority ASC";
  $query = $conn->query($sql);
  while($row = $query->fetch_assoc()){
    $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
    $cquery = $conn->query($sql);
    $carray = array();
    $varray = array();
    while($crow = $cquery->fetch_assoc()){
      array_push($carray, $crow['lastname']);
      $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
      $vquery = $conn->query($sql);
      array_push($varray, $vquery->num_rows);
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);
    ?>
    <script>
    $(function(){
      var rowid = '<?php echo $row['id']; ?>';
      var description = '<?php echo slugify($row['description']); ?>';
      var barChartCanvas = $('#'+description).get(0).getContext('2d')
      var barChart = new Chart(barChartCanvas)
      var barChartData = {
        labels  : <?php echo $carray; ?>,
        datasets: [
          {
            label               : 'Votes',
            fillColor           : 'rgba(60,141,188,0.9)',
            strokeColor         : 'rgba(60,141,188,0.8)',
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : <?php echo $varray; ?>
          }
        ]
      }
      var barChartOptions                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
      }

      barChartOptions.datasetFill = false
      var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
      //document.getElementById('legend_'+rowid).innerHTML = myChart.generateLegend();
    });
    </script>
    <?php
  }
?>

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

</body>
</html>
