<?php
	include 'includes/session.php';

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];

		// First delete associated votes
		$sql_votes = "DELETE FROM votes WHERE election_id = '$id'";
		if (!$conn->query($sql_votes)) {
			$_SESSION['error'] = 'Failed to delete associated votes: ' . $conn->error;
			header('location: elections.php');
			exit();
		}

		// Then delete the election
		$sql = "DELETE FROM elections WHERE id = '$id'";
		if ($conn->query($sql)) {
			if ($conn->affected_rows > 0) {
				$_SESSION['success'] = 'Election and associated votes deleted successfully';
			} else {
				$_SESSION['error'] = 'No election found';
			}
		} else {
			$_SESSION['error'] = $conn->error;
		}
	} else {
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: elections.php');
?>
