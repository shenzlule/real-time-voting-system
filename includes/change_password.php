<?php
include 'includes/session.php';

if (isset($_POST['change'])) {
    $current = $_POST['current'];
    $new = $_POST['new'];
    $retype = $_POST['retype'];
    $voterid = $user['id']; // Assumes session holds logged-in voter info
    

    if ($new != $retype) {
        $_SESSION['error'] = 'New password and confirmation do not match';
    } 
    else {
        $sql = "SELECT * FROM voters WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $voterid);
        $stmt->execute();
        $result = $stmt->get_result();
        $voter = $result->fetch_assoc();

        if (password_verify($current, $voter['password'])) {
            $hashed = password_hash($new, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE voters SET password = ? WHERE id = ?");
            $update->bind_param("si", $hashed, $voterid);

            if ($update->execute()) {
                $_SESSION['success'] = 'Password updated successfully';
            } else {
                $_SESSION['error'] = 'Database error: ' . $update->error;
            }
        } else {
            $_SESSION['error'] = 'Incorrect current password';
        }
    }
} else {
    $_SESSION['error'] = 'Please submit the password change form';
}





header('location: profile.php');
exit();
?>
