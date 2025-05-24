
<?php
include 'includes/session.php';

if(isset($_GET['return'])){
	$return = $_GET['return'];
	
}
else{
	$return = 'overview.php';
}


if (isset($_POST['change'])) {
    $current = $_POST['current'];
    $new = $_POST['new'];
    $retype = $_POST['retype'];
    $adminnid = $user['id']; // Assumes session holds logged-in voter info
    

    if ($new != $retype) {
        $_SESSION['error'] = 'New password and confirmation do not match';
    } 
    else {
        $sql = "SELECT * FROM admin WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $adminnid);
        $stmt->execute();
        $result = $stmt->get_result();
        $adminn = $result->fetch_assoc();

        if (password_verify($current, $adminn['password'])) {
            $hashed = password_hash($new, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
            $update->bind_param("si", $hashed, $adminnid);

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





header('location:'.$return);
exit();
?>
