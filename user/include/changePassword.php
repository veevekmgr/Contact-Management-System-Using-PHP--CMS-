<?php
include '../../include/topInclude.php';
if (isset($_POST['submit'])) {
    $username = $_SESSION['NAME'];
    $oldPassword = md5($_POST['oldPassword']);
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['conPassword'];

    //SQL Query 
    $sql_check = "SELECT * FROM user WHERE username = '$username'";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
    $password = $result['password'];

    //Validation
    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        echo "<script> alert('Field are empty!');document.location='../setting.php';</script>";
    } elseif (strlen($newPassword) < 8) {
        echo "<script> alert('Password too short. Minimun 8 digits required!');document.location='../setting.php';</script>";
    } elseif ($oldPassword != $password) {
        echo "<script> alert('Old Password doesnot match!');document.location='../setting.php';</script>";
    } elseif ($newPassword != $confirmPassword) {
        echo "<script> alert('Password doesnot match!');document.location='../setting.php';</script>";
    } else {

        //Update Query
        $sql_changePass = "UPDATE user SET password = md5('$newPassword') WHERE username = '$username'";
        $stmt_changePass = $conn->prepare($sql_changePass);
        $stmt_changePass->execute();

        //Insert into log table
        if ($stmt_changePass) {
            $log_msg = $username . ' ' . 'Password Changed';
            $log_section = 'New Password';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
        }
        echo "<script> alert('Password Changed!');document.location='../setting.php';</script>";
        die();
    }
}
