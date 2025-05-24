<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM elections WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Election deleted successfully';
    } else {
        $_SESSION['error'] = 'Failed to delete: ' . $stmt->error;
    }
}

header('location: elections.php');
?>
