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
        Votes Tally
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">results</li>
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
          <h3>
          <a href="print.php" target="_blank" class="btn btn-success btn-sm btn-flat pull-right">
  <span class="glyphicon glyphicon-print"></span> Print
</a>

          </h3>
        </div>
      </div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
<div id="chart-grid"  class="grid grid-cols-1 lg:grid-cols-2 gap-4">
<?php
$sql = "SELECT * FROM positions ORDER BY priority ASC";
$query = $conn->query($sql);

$chartConfigs = []; // store chart info for later rendering

while ($row = $query->fetch_assoc()) {
    $positionId = $row['id'];
    $positionTitle = htmlspecialchars($row['description']);
    $slug = 'chart_' . slugify($positionTitle);

    // Fetch candidates and their vote counts
    $candidates = [];
    $votes = [];
    $colors = [];

    $csql = "SELECT id, lastname FROM candidates WHERE position_id = '$positionId'";
    $cquery = $conn->query($csql);

    while ($crow = $cquery->fetch_assoc()) {
        $candidates[] = $crow['lastname'];

        $vsql = "SELECT COUNT(*) AS total FROM votes WHERE candidate_id = '{$crow['id']}'";
        $vquery = $conn->query($vsql);
        $vrow = $vquery->fetch_assoc();
        $votes[] = (int)$vrow['total'];

        // Generate random color for the pie slice
        $colors[] = sprintf('rgba(%d,%d,%d,0.8)', rand(50,200), rand(50,200), rand(50,200));
    }

    // Fallback UI when no candidates found
    if (empty($candidates)) {
       
        continue;
    }

    $labels = json_encode($candidates);
    $data = json_encode($votes);
    $bgColors = json_encode($colors);

    echo <<<HTML
    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
        <details class="group" open>
            <summary class="bg-blue-600 px-6 py-4 text-white font-bold cursor-pointer flex justify-between items-center">
                $positionTitle
                <span class="transition-transform group-open:rotate-180">&#x25BC;</span>
            </summary>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <canvas id="$slug" class="w-full h-64"></canvas>
                </div>
                <div>
HTML;

    $maxVote = !empty($votes) ? max($votes) : 1;
    if ($maxVote == 0) {
        $maxVote = 1; // avoid division by zero
    }

    foreach ($candidates as $i => $name) {
        $percent = round(($votes[$i] / $maxVote) * 100);
        echo "
            <div class='mb-4'>
                <div class='text-sm font-semibold mb-1'>$name ({$votes[$i]} votes)</div>
                <div class='w-full bg-gray-200 rounded-full h-4'>
                    <div class='h-4 rounded-full' style='width: {$percent}%; background-color: {$colors[$i]};'></div>
                </div>
            </div>
        ";
    }

    echo <<<HTML
                </div>
            </div>
        </details>
    </div>
HTML;

    // Store chart config for rendering at end
    $chartConfigs[] = <<<JS
    {
        id: "$slug",
        labels: $labels,
        data: $data,
        backgroundColor: $bgColors
    }
JS;
}

// Render charts all at once
if (!empty($chartConfigs)) {
    echo '<script>';
    echo 'const charts = [' . implode(',', $chartConfigs) . '];';
    echo <<<JS
    charts.forEach(chart => {
        const ctx = document.getElementById(chart.id).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chart.labels,
                datasets: [{
                    label: 'Votes',
                    data: chart.data,
                    backgroundColor: chart.backgroundColor,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
JS;
    echo '</script>';
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
<!-- 
<script>
const chartInstances = {};

function renderCharts(data) {
    const container = document.getElementById('chart-grid');
    container.innerHTML = '';

    data.forEach(item => {
        const card = document.createElement('div');
        card.className = "bg-white rounded-xl shadow border border-gray-200 overflow-hidden";

        card.innerHTML = `
            <details class="group" open>
                <summary class="bg-blue-600 px-6 py-4 text-white font-bold cursor-pointer flex justify-between items-center">
                    ${item.title}
                    <span class="transition-transform group-open:rotate-180">&#x25BC;</span>
                </summary>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><canvas id="${item.id}" class="w-full h-64"></canvas></div>
                    <div>
                        ${item.labels.map((name, i) => {
                            const percent = item.data[i] === 0 ? 0 : Math.round((item.data[i] / Math.max(...item.data)) * 100);
                            return `
                                <div class='mb-4'>
                                    <div class='text-sm font-semibold mb-1'>${name} (${item.data[i]} votes)</div>
                                    <div class='w-full bg-gray-200 rounded-full h-4'>
                                        <div class='h-4 rounded-full' style='width: ${percent}%; background-color: ${item.backgroundColor[i]};'></div>
                                    </div>
                                </div>
                            `;
                        }).join('')}
                    </div>
                </div>
            </details>
        `;

        container.appendChild(card);

        const ctx = card.querySelector(`#${item.id}`).getContext('2d');

        if (chartInstances[item.id]) {
            chartInstances[item.id].destroy();
        }

        chartInstances[item.id] = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: item.labels,
                datasets: [{
                    label: 'Votes',
                    data: item.data,
                    backgroundColor: item.backgroundColor,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
}

function fetchChartData() {
    fetch('chart-data.php')
        .then(res => res.json())
        .then(renderCharts)
        .catch(err => console.error("Error loading chart data:", err));
}

// Initial load
fetchChartData();

// Refresh every 1 minute
setInterval(fetchChartData, 30000);
</script>
 -->





</body>
</html>
