<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	$sql = "SELECT * FROM positions";
	$pquery = $conn->query($sql);

	$output = '';
	$candidate = '';

	$sql = "SELECT * FROM positions ORDER BY priority ASC";
	$query = $conn->query($sql);
	$num = 1;
	while($row = $query->fetch_assoc()){
		$input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.slugify($row['description']).'" name="'.slugify($row['description'])."[]".'">' : '<input type="radio" class="flat-red '.slugify($row['description']).'" name="'.slugify($row['description']).'">';

		$sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
		$cquery = $conn->query($sql);
		while($crow = $cquery->fetch_assoc()){
			$image = (!empty($crow['photo'])) ? '../images/'.$crow['photo'] : '../images/profile.jpg';
			$candidate .= '
			<li class="flex items-center space-x-4 bg-gray-50 hover:bg-gray-100 p-4 rounded-lg shadow-sm transition duration-200 mb-2">
			 
			 
			  <img src="'.$image.'" alt="Candidate Image" class="w-16 h-16 rounded-full object-cover shadow-md border border-gray-300 clist" />

			  <div class="flex flex-col">
      <span class="cname clist text-gray-800 font-medium">'.$crow['firstname'].' '.$crow['lastname'].'</span>
      <span class="clist text-sm text-gray-600 font-medium">'.$crow['campaign_slogan'].'</span>
    </div>
			</li>
		  ';
		  
		}

		$instruct ='Candidates';
		
		$updisable = ($row['priority'] == 1) ? 'disabled' : '';
		$downdisable = ($row['priority'] == $pquery->num_rows) ? 'disabled' : '';

		$output .= '
<div class="flex flex-col mt-4 gap-4 w-full" id="'.$row['id'].'">
  <div class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300">
    
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-t-2xl">
      <h3 class="text-white font-semibold text-lg">
        <b>'.$row['description'].'</b>
      </h3>
      <div class="flex space-x-2">
        <button type="button" class="btn moveup text-white hover:bg-indigo-600 bg-indigo-400 px-3 py-1 rounded-md text-sm" data-id="'.$row['id'].'" '.$updisable.'>
          <i class="fa fa-arrow-up"></i>
        </button>
        <button type="button" class="btn movedown text-white hover:bg-purple-600 bg-purple-400 px-3 py-1 rounded-md text-sm" data-id="'.$row['id'].'" '.$downdisable.'>
          <i class="fa fa-arrow-down"></i>
        </button>
      </div>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-4">
      <div class="flex justify-between items-center">
        <p class="text-gray-700">'.$instruct.'</p>
       
      </div>

      <!-- Candidate List -->
      <div id="candidate_list" class="pl-4">
        <ul class="list-disc text-gray-800 space-y-1">
          '.$candidate.'
        </ul>
      </div>
    </div>
    
  </div>
</div>';


		$sql = "UPDATE positions SET priority = '$num' WHERE id = '".$row['id']."'";
		$conn->query($sql);

		$num++;
		$candidate = '';
	}

	echo json_encode($output);

?>