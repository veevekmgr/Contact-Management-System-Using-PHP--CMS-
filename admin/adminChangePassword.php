<?php
include '../include/topInclude.php';

$username = $_GET['username'];
if (isset($_POST['submit'])) {

    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['conPassword'];

    $sql_check = "SELECT * FROM user WHERE username = '$username'";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
    $password = $result['password'];

    if (empty($newPassword) || empty($confirmPassword)) {
        echo "<script> alert('Field are empty!');document.location='adminEditUser.php?username=$username';</script>";
    } elseif (strlen($newPassword) < 8) {
        echo "<script> alert('Password too short. Minimun 8 digits required!');document.location='adminEditUser.php?username=$username';</script>";
    } elseif ($newPassword != $confirmPassword) {
        echo "<script> alert('Password doesnot match!');document.location='adminEditUser.php?username=$username';</script>";
    } else {
        $sql_changePass = "UPDATE user SET password=md5('$newPassword') WHERE username = '$username'";

        $stmt_changePass = $conn->prepare($sql_changePass);
        $stmt_changePass->execute();

        if ($stmt_changePass) {
            $log_msg = $username . ' ' . 'Password Changed by Admin';
            $log_section = 'New Password';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
        }
        echo "<script> alert('Password Changed!');document.location='adminEditUser.php?username=$username';</script>";
        die();
    }
}
