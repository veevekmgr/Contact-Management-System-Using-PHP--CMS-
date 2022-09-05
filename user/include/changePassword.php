<?php
include '../../include/topInclude.php';
if (isset($_POST['submit'])) {
    $username = $_SESSION['NAME'];

    $oldPassword = md5($_POST['oldPassword']);
    $newPassword = md5($_POST['newPassword']);
    $confirmPassword = md5($_POST['conPassword']);

    $sql_check = "SELECT * FROM user WHERE username = '$username'";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
    $password = $result['password'];

    $pw = strlen($newPassword);
    if ($pw >= 8) {
        if ($oldPassword == $password) {

            if ($newPassword == $confirmPassword) {
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
                echo "<script> alert('Password Changed!');document.location='../setting.php';</script>";
                die();
            } else {
                echo "<script> alert('New Password doesnot match!');document.location='../setting.php';</script>";
                die();
            }
        }
        echo "<script> alert('Password too short. Minimun 8 digits required!');document.location='../setting.php';</script>";
    } else {
        echo "<script> alert('Old Password doesnot match!');document.location='../setting.php';</script>";
        die();
    }
}
