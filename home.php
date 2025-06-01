<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>
<script src="css/tailwind_3_4_1_6.css"></script>

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
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-gray-100 rounded-xl shadow-inner">
  
  <!-- 🗳️ Vote Status Card -->
  <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-200">
    <div class="flex items-center mb-4">
      <div class="bg-blue-100 p-3 rounded-full text-blue-600 mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 12l2 2l4 -4" />
          <path d="M20 6v14a2 2 0 0 1 -2 2H6a2 2 0 0 1 -2-2V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2" />
        </svg>
      </div>
      <h3 class="text-xl font-bold text-gray-800">Vote Status</h3>
    </div>
    <p class="text-gray-600 mb-4">Check your voting status or proceed to vote securely.</p>
    <a href="vote.php" class="inline-block px-4 py-2 bg-blue-500 text-white text-md rounded-full hover:bg-blue-600 transition">Go to Vote</a>
  </div>

  <!-- 🤖 AI Insights Card -->
  <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-200">
    <div class="flex items-center mb-4">
      <div class="bg-green-100 p-3 rounded-full text-green-600 mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 20v-6m0 0V8m0 6h6m-6 0H6" />
        </svg>
      </div>
      <h3 class="text-xl font-bold text-gray-800">AI Insights</h3>
    </div>
    <p class="text-gray-600 mb-4">Chat with the AI bot to learn more about the candidates and election.</p>
    <a href="voting_bot.php" class="inline-block px-4 py-2 bg-green-500 text-white text-md rounded-full hover:bg-green-600 transition">Open Chatbot</a>
  </div>

</div>



<div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-gray-100 rounded-xl shadow-inner">
  <!-- 📊 Voting Results Card -->
<div id="votingResultsCard" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-200">
  <div class="flex items-center mb-4">
    <div class="bg-purple-100 p-3 rounded-full text-purple-600 mr-4">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
           viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 3v18h18" />
        <path d="M18 17V9m-4 8V5m-4 12v-6m-4 6v-3" />
      </svg>
    </div>
    <h3 class="text-xl font-bold text-gray-800">Voting Results</h3>
  </div>
  <p class="text-gray-600 mb-4">See the latest results and statistics from the current election.</p>
  <a href="results.php" class="inline-block px-4 py-2 bg-purple-500 text-white text-md rounded-full hover:bg-purple-600 transition">View Results</a>
</div>

<!-- 📄 Download Voter Guide Card -->
<div id="voterGuideCard"  class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-200">
  <div class="flex items-center mb-4">
    <div class="bg-yellow-100 p-3 rounded-full text-yellow-600 mr-4">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
           viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 5v14m0 0l-6-6m6 6l6-6" />
      </svg>
    </div>
    <h3 class="text-xl font-bold text-gray-800">Voter Guide</h3>
  </div>
  <p class="text-gray-600 mb-4">Download a guide with candidate info, how to vote, and key election dates.</p>
  <a href="./generate_voter_guide.php" target="_blank"   class="inline-block px-4 py-2 bg-yellow-500 text-white text-md rounded-full hover:bg-yellow-600 transition">
    Download Voter Guide
  </a>
</div>


</div>
<div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">

  <!-- 👥 View Candidates Section -->
  <div  id="viewCandidatesSection" class="bg-white shadow-md rounded-2xl p-4">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-bold flex items-center space-x-2 text-blue-700">
        <i class="fas fa-users"></i> <!-- 👥 Icon for candidates -->
        <span>View Candidates</span>
      </h2>
      <a href="candidates.php">
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center space-x-2">
          <i class="fas fa-eye"></i> <!-- 👁️ Eye icon for view -->
          <span>See All</span>
        </button>
      </a>
    </div>

    <!-- Random Candidate Card -->
    <?php
  $rand_sql = "SELECT * FROM candidates ORDER BY RAND() LIMIT 1";
  $rand_query = $conn->query($rand_sql);

  if ($rand_query->num_rows > 0):
    $cand = $rand_query->fetch_assoc();
    $image = (!empty($cand['photo'])) ? 'images/'.$cand['photo'] : 'images/profile.jpg';
    $name = $cand['firstname'] . ' ' . $cand['lastname'];
    $quote = !empty($cand['platform']) ? '"' . $cand['platform'] . '"' : '"I am committed to serving students."';
?>
<!-- 🎲 Random Candidate Card -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
  <div class="bg-gray-100 p-4 rounded-xl text-center transition-transform transform hover:scale-105 duration-300">
    <img src="<?php echo $image; ?>" class="mx-auto w-24 h-24 rounded-full object-cover mb-2" alt="<?php echo $name; ?>">
    <h3 class="font-semibold text-lg"><?php echo $name; ?></h3>
    <p class="text-sm text-gray-600 mb-3"><?php echo $quote; ?></p>
    <a href="candidates.php">
      <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 w-full">
        <i class="fas fa-user-tag mr-1"></i> Ask me
      </button>
    </a>
  </div>
</div>

<?php else: ?>
<!-- ❌ No Candidates Available -->
<div class="bg-red-100 text-red-600 border border-red-200 p-4 rounded-lg text-center">
  <i class="fas fa-user-slash text-2xl mb-2"></i>
  <p class="font-semibold">No candidate information available at the moment.</p>
</div>
<?php endif; ?>




  </div>

  <!-- 🗓️ Election Countdown -->
<!-- 🗓️ Election Countdown -->
<div class="bg-white shadow-md rounded-2xl p-4 flex flex-col justify-between">
  <?php
    
    // Prioritize ongoing, then upcoming
    $sql = "SELECT * FROM elections 
            WHERE status IN ('ongoing', 'upcoming') 
            ORDER BY FIELD(status, 'ongoing', 'upcoming'), election_date ASC 
            LIMIT 1";
    $query = $conn->query($sql);

    $title = "No Active Election";
    $voting_status = "Voting ended";
    $countdown_time = null;

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $title = $row['election_name'];

        $start_datetime = strtotime($row['election_date'] . ' ' . $row['start_time']);
        $end_datetime = strtotime($row['election_date'] . ' ' . $row['end_time']);
        $now = time();

        if ($row['status'] == 'ongoing') {
            $voting_status = "Voting in progress";
            $countdown_time = $end_datetime;
        } elseif ($row['status'] == 'upcoming') {
            $voting_status = "Voting yet to start";
            $countdown_time = $start_datetime;
        }
    }
  ?>

  <h2 class="text-xl font-bold mb-2 flex items-center space-x-2 text-red-600">
    <i class="fas fa-hourglass-half"></i>
    <span>Election Countdown</span>
  </h2>

  <div class="text-sm text-gray-700 mb-1">
    <strong>Election:</strong> <?php echo strtoupper($title); ?>
  </div>
  <div class="text-sm text-gray-600 mb-4">
    <strong>Status:</strong> <?php echo $voting_status; ?>
  </div>

  <div class="text-center text-4xl font-semibold text-red-500" id="countdown">
    <?php echo ($countdown_time ? 'Loading...' : 'Voting closed'); ?>
  </div>
</div>

<?php if ($countdown_time): ?>
<script>
  window.onload = function () {
    const countdown = document.getElementById('countdown');
    const endDate = new Date(<?php echo $countdown_time * 1000; ?>).getTime();

    const timer = setInterval(() => {
      const now = new Date().getTime();
      const distance = endDate - now;

      if (distance < 0) {
        clearInterval(timer);
        countdown.innerHTML = <?php
if ($voting_status == 'Voting yet to start') {
    echo 'Voting yet to start';
} elseif ($voting_status == 'Voting ongoing') {
    echo 'Voting Closed';
} elseif ($voting_status == 'Voting completed') {
    echo 'Results Published';
} else {
    echo 'Unknown Status';
}
?>
;
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      countdown.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }, 1000);
  };
</script>
<?php endif; ?>



  <!-- 🔐 Account Details -->
  <div class="bg-white shadow-md rounded-2xl p-4 col-span-1 lg:col-span-2">
    <h2 class="text-xl font-bold mb-4">Account Details</h2>
    <div class="flex flex-col sm:flex-row justify-between text-md">
      <div>
        <p><span class="font-semibold">Name:</span> <?php echo $voter['firstname'].' '.$voter['lastname']; ?></p>
        <p><span class="font-semibold">Student ID:</span> <?php echo $voter['voters_id']; ?></p>
        <p><span class="font-semibold">Voter Status:</span> Eligible</p>
      </div>
      <div class="mt-2 sm:mt-0">
      <a href="profile.php">
  <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
    Update Profile
  </button>
</a>
      </div>
    </div>
  </div>
</div>




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
<script>
  document.addEventListener('DOMContentLoaded', () => {
  const votingResults = document.getElementById('votingResultsCard');
  const voterGuide = document.getElementById('voterGuideCard');
  const viewCandidates = document.getElementById('viewCandidatesSection');

  // Pulse animation on load to draw attention
  [votingResults, voterGuide, viewCandidates].forEach(card => {
    card.animate([
      { boxShadow: '0 0 0px rgba(0,0,0,0)' },
      { boxShadow: '0 0 15px rgba(66,153,225,0.6)' },
      { boxShadow: '0 0 0px rgba(0,0,0,0)' }
    ], {
      duration: 1500,
      iterations: 2,
    });
  });

  // Add active scale & glow effect on mouse enter/leave for each card
  [votingResults, voterGuide, viewCandidates].forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
      card.style.transform = 'scale(1.05)';
      card.style.boxShadow = '0 10px 25px rgba(66,153,225,0.5)';
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'scale(1)';
      card.style.boxShadow = ''; // revert to default shadow from CSS
    });
  });
});

</script>
</body>
</html>
