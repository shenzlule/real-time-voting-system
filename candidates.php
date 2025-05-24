<?php include 'includes/session.php';
// $sql = "SELECT * FROM candidates ORDER BY id ASC";

// Custom color palette for position IDs
$colorMap = [
  1 => 'blue',
  2 => 'green',
  3 => 'red',
  4 => 'purple',
  5 => 'yellow',
  6 => 'indigo',
  7 => 'pink',
  8 => 'teal',
  9 => 'orange',
  10 => 'rose',
  11 => 'lime',
  12 => 'amber',
  13 => 'violet',
  14 => 'fuchsia',
  15 => 'cyan',
  16 => 'emerald',
];

$sql = "SELECT 
          candidates.*, 
          positions.description AS position_title
        FROM candidates 
        LEFT JOIN positions 
          ON candidates.position_id = positions.id 
        ORDER BY positions.priority ASC, candidates.id ASC";

$query = $conn->query($sql);


$grouped = [];

// Group candidates by position
while ($row = $query->fetch_assoc()) {
    $position = $row['position_title'] ?: 'Unspecified Position';
    $grouped[$position][] = $row;
}

// Move 'Unspecified Position' to the end
if (isset($grouped['Unspecified Position'])) {
  $unspecified = $grouped['Unspecified Position'];
  unset($grouped['Unspecified Position']);
  $grouped['Unspecified Position'] = $unspecified;
}
?>


<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">
	
<?php include './includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>


  <style>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.7s ease-out;
}
</style>



  <div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
      View Candidates
</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">candidates</li>
      </ol>
    </section>


<!-- Main content -->
<section class="content ">


<?php foreach ($grouped as $position => $candidates): ?>
  <?php
    // Pick color class from first candidate’s position ID
    $first = $candidates[0];
    $color = $colorMap[$first['position_id']] ?? 'gray';
  ?>

  <div class="mb-12">
    <h2 class="text-3xl font-bold text-<?php echo $color; ?>-700 mb-2 border-l-4 border-<?php echo $color; ?>-500 pl-4 shadow-sm">
      <?php echo htmlspecialchars($position); ?>
    </h2>
    <hr class="border-t-2 border-<?php echo $color; ?>-300 mb-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($candidates as $candidate): ?>
        <div class="bg-white border-l-4 border-<?php echo $color; ?>-500 shadow-xl rounded-2xl p-6 transform hover:scale-105 transition duration-300">
          <img src="images/<?php echo htmlspecialchars($candidate['photo']) ?: 'default.jpg'; ?>" 
               alt="Candidate Photo" 
               class="w-32 h-32 rounded-full mx-auto shadow-lg object-cover border-4 border-<?php echo $color; ?>-200">
          <h3 class="text-xl font-semibold text-center mt-4 text-gray-800">
            <?php echo htmlspecialchars($candidate['firstname'] . ' ' . $candidate['lastname']); ?>
          </h3>
          <p class="text-center italic text-<?php echo $color; ?>-600 mt-1">
            "<?php echo htmlspecialchars($candidate['campaign_slogan']); ?>"
          </p>
          <p class="text-sm text-gray-600 text-center mt-2">
            <?php echo htmlspecialchars($candidate['content']); ?>
          </p>
          <div class="mt-4 flex justify-center">
            <button class="bg-<?php echo $color; ?>-600 hover:bg-<?php echo $color; ?>-700 text-white px-5 py-2 rounded-full shadow-md transition-all duration-300">
              Ask Me
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endforeach; ?>
</section>

<div class="container">

</div>
</div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/ballot_modal.php'; ?>
    
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
$(function(){
	$('.content').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	});

	$(document).on('click', '.reset', function(e){
	    e.preventDefault();
	    var desc = $(this).data('desc');
	    $('.'+desc).iCheck('uncheck');
	});

	$(document).on('click', '.platform', function(e){
		e.preventDefault();
		$('#platform').modal('show');
		var platform = $(this).data('platform');
		var fullname = $(this).data('fullname');
		$('.candidate').html(fullname);
		$('#plat_view').html(platform);
	});

	$('#preview').click(function(e){
		e.preventDefault();
		var form = $('#ballotForm').serialize();
		if(form == ''){
			$('.message').html('You must vote atleast one candidate');
			$('#alert').show();
		}
		else{
			$.ajax({
				type: 'POST',
				url: 'preview.php',
				data: form,
				dataType: 'json',
				success: function(response){
					if(response.error){
						var errmsg = '';
						var messages = response.message;
						for (i in messages) {
							errmsg += messages[i]; 
						}
						$('.message').html(errmsg);
						$('#alert').show();
					}
					else{
						$('#preview_modal').modal('show');
						$('#preview_body').html(response.list);
					}
				}
			});
		}
		
	});

});
</script>

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


</body>
</html>
