<?php include 'includes/session.php'; ?>

<?php
  $title_ = 'No Active Election';
  $voting_status = 'Ended';
  $election = null;
  $has_active_election = false; // 🚩 Your boolean flag
  $election_id = null; // 🆕 Add this to store the ID

  $sql = "SELECT * FROM elections 
          WHERE status IN ('ongoing', 'none') 
          ORDER BY FIELD(status, 'ongoing', 'none'), election_date ASC, start_time ASC 
          LIMIT 1";
  $query = $conn->query($sql);

  if ($query->num_rows > 0) {
    $election = $query->fetch_assoc();
    $election_id = $election['id']; // 🆕 Capture the election ID
    $title_ = $election['election_name'];
    $has_active_election = true; // ✅ Set to true since a valid election was found

    $now = time();
    $start = strtotime($election['election_date'] . ' ' . $election['start_time']);
    $end = strtotime($election['election_date'] . ' ' . $election['end_time']);

    if ($now >= $start && $now <= $end) {
      $voting_status = 'Voting in progress';
    } elseif ($now < $start) {
      $voting_status = 'Voting yet to start';
    } else {
      $voting_status = 'Voting closed';
    }
  }
?>



<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">
	
<?php include './includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	     
		  <section class="px-6 py-10">
  <h1 class="text-3xl md:text-4xl font-extrabold text-center text-blue-700 mb-10 tracking-wider">
    <?php echo $title_; ?>
  </h1>

  <?php if ($has_active_election): ?>
  <div class="max-w-5xl mx-auto">
    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
        <strong class="font-bold">Error!</strong>
        <ul class="list-disc pl-5">
          <?php foreach ($_SESSION['error'] as $error): ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline"><?php echo $_SESSION['success']; ?></span>
        <?php unset($_SESSION['success']); ?>
      </div>
    <?php endif; ?>

    <div id="alert" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
      <span class="message"></span>
    </div>

    <?php 
  $sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."' AND election_id = '".$election_id."'";

	$vquery = $conn->query($sql);
	if ($vquery->num_rows > 0): ?>
      <div class="text-center mb-10">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">You have already voted for this election.</h3>
        <a href="#view" data-toggle="modal" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition">View Ballot</a>
      </div>
    <?php else: ?>
      <form method="POST" id="ballotForm" action="submit_ballot.php" class="space-y-10">
      <input type="hidden" name="election_id" value="<?php echo $election_id; ?>">

        <?php
          include 'includes/slugify.php';
          $candidate = '';
          $sql = "SELECT * FROM positions ORDER BY priority ASC";
          $query = $conn->query($sql);
          while ($row = $query->fetch_assoc()) {
            $sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
            $cquery = $conn->query($sql);
            while ($crow = $cquery->fetch_assoc()) {
              $slug = slugify($row['description']);
              $checked = '';
              if (isset($_SESSION['post'][$slug])) {
                $value = $_SESSION['post'][$slug];
                if (is_array($value)) {
                  foreach ($value as $val) {
                    if ($val == $crow['id']) {
                      $checked = 'checked';
                    }
                  }
                } else {
                  if ($value == $crow['id']) {
                    $checked = 'checked';
                  }
                }
              }
              $input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 '.$slug.'" name="'.$slug.'[]" value="'.$crow['id'].'" '.$checked.'>' : '<input type="radio" class="form-radio h-5 w-5 text-blue-600 '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
              $image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';
              $candidate .= '
               
                <li class="flex items-center space-x-4 bg-gray-50 hover:bg-gray-100 p-4 rounded-lg shadow-sm transition duration-200 mb-2">
			 
                '.$input.'
			  <img src="'.$image.'" alt="Candidate Image" class="w-16 h-16 rounded-full object-cover shadow-md border border-gray-300 clist" />

			  <div class="flex flex-col">
      <span class="cname clist text-gray-800 font-medium">'.$crow['firstname'].' '.$crow['lastname'].'</span>
      <span class="clist text-sm text-gray-600 font-medium">'.$crow['campaign_slogan'].'</span>
    </div>
			</li>

              ';
            }

            $instruct = ($row['max_vote'] > 1) ? 'You may select up to '.$row['max_vote'].' candidates' : 'Select only one candidate';

            echo '
              <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-700 mb-2">'.$row['description'].'</h3>
                <p class="text-sm text-gray-500 mb-4">'.$instruct.'
                  <button type="button" class="ml-4 text-xs text-green-600 hover:underline reset" data-desc="'.slugify($row['description']).'">
                    <i class="fa fa-refresh"></i> Reset
                  </button>
                </p>
                <ul class="space-y-4">'.$candidate.'</ul>
              </div>
            ';

            $candidate = '';
          }
        ?>
        <div class="flex justify-center space-x-4">
          <button type="button" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full transition" id="preview">
            <i class="fa fa-file-text"></i> Preview
          </button>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition" name="vote">
            <i class="fa fa-check-square-o"></i> Submit
          </button>
        </div>
      </form>
    <?php endif; ?>
  </div>
  <?php endif; ?>

</section>

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
