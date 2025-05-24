<?php
session_start();
include 'includes/session.php'; // Your session and DB connection

if (isset($_POST['set_election'])) {
    $election_id = intval($_POST['election_id']);

    // Optional: Validate election ID exists
    $sql = "SELECT id FROM elections WHERE id = $election_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['selected_election'] = $election_id;
        header('Location: vote_results.php'); // Redirect back to dashboard or wherever
        exit();
    } else {
        $_SESSION['error'] = "Invalid election selected.";
        header('Location: overview.php'); // Redirect back to dashboard or wherever
        exit();
    }
} else {
    $_SESSION['error'] = "No election selected.";
    header('Location: overview.php'); // Redirect back to dashboard or wherever
    exit();
}

header('Location: overview.php'); // Redirect back to dashboard or wherever
exit();
?>
