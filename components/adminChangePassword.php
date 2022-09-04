<?php
include '../topInclude.php';

$username = $_GET['username'];
if (isset($_POST['submit'])) {

    $newPassword = md5($_POST['newPassword']);
    $confirmPassword = md5($_POST['conPassword']);

    $sql_check = "SELECT * FROM user WHERE username = '$username'";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
    $password = $result['password'];

    if (strlen($newPassword) < 8) {
        echo "<script> alert('Password is too short. Maximum 8 digit required');document.location='../adminDashboard.php';</script>";
    } elseif ($newPassword == $confirmPassword) {
        $sql_changePass = "UPDATE user SET password='$newPassword' WHERE username = '$username'";
        $stmt_changePass = $conn->prepare($sql_changePass);
        $stmt_changePass->execute();

        if ($stmt_changePass) {
            $log_msg = $username . ' ' . 'Password Changed';
            $log_section = 'New Password';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
        }
        echo "<script> alert('Password Changed!');document.location='../adminEditUser.php';</script>";
        die();
    } else {
        echo "<script> alert('New Password doesnot match!');document.location='../adminEditUser.php';</script>";
        die();
    }
}
