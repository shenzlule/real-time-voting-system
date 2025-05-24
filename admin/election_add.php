<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $election_name = $_POST['election_name'];
    $election_date = $_POST['election_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Check if any election already exists
    $check = $conn->prepare("SELECT id FROM elections LIMIT 1");
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // There is already an election present
        $_SESSION['error'] = 'Only one election is allowed at a time. Please delete the existing election before adding a new one.';
    } else {
        // Insert new election
        $stmt = $conn->prepare("INSERT INTO elections (election_name, election_date, start_time, end_time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $election_name, $election_date, $start_time, $end_time);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Election added successfully';
        } else {
            $_SESSION['error'] = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    }

    $check->close();
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: elections.php');
?>
