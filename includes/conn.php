<?php
	$conn = new mysqli('localhost', 'root', '', 'real_time_voting_system');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>