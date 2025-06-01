<?php
include 'includes/session.php';

if (isset($_POST['reset'])) {
    $id = $_POST['id'];

    // Delete all votes associated with this election
    $deleteVotes = $conn->prepare("DELETE FROM votes WHERE election_id = ?");
    $deleteVotes->bind_param("i", $id);
    $deleteVotes->execute();

    $election_name = $_POST['election_name'];
    $election_date = $_POST['election_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $status = "upcoming";


    
    // New inputs
    $release_results = isset($_POST['release_results']) ? (int)$_POST['release_results'] : 0;
    $release_voting_guide = isset($_POST['release_voting_guide']) ? (int)$_POST['release_voting_guide'] : 0;

    // If status is being set to 'ongoing', reset others to 'upcoming'
    if ($status === 'ongoing') {
        $updateOthers = "UPDATE elections SET status = 'upcoming' WHERE status = 'ongoing' AND id != ?";
        $stmt1 = $conn->prepare($updateOthers);
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
    }

    // Now update the selected election
    $stmt = $conn->prepare("UPDATE elections SET  election_date = ?, start_time = ?, end_time = ?, status = ?, release_results = ?, release_voting_guide = ? WHERE id = ?");
    $stmt->bind_param("ssssiii", $election_date, $start_time, $end_time, $status, $release_results, $release_voting_guide, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Election and votes reset successfully';
    } else {
        $_SESSION['error'] = 'Update failed: ' . $stmt->error;
    }
} else {
    $_SESSION['error'] = 'Election ID missing from request.';
}

header('Location: elections.php');
exit();
?>
