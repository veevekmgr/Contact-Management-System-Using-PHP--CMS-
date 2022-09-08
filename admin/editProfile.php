<?php
include '../include/topInclude.php';
$username = $_SESSION['NAME'];
$sql_check = "SELECT * FROM user WHERE username = '$username'";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->execute();
$result = $stmt_check->fetch(PDO::FETCH_ASSOC);
$dbfullname = $result['fullname'];
$dbemail = $result['email'];
$dbcontact = $result['contact'];

if (isset($_POST['submit-Pass'])) {
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
        echo "<script> alert('Field are empty!');document.location='adminSetting.php';</script>";
    } elseif (strlen($newPassword) < 8) {
        echo "<script> alert('Password too short. Minimun 8 digits required!');document.location='adminSetting.php';</script>";
    } elseif ($oldPassword != $password) {
        echo "<script> alert('Old Password doesnot match!');document.location='adminSetting.php';</script>";
    } elseif ($newPassword != $confirmPassword) {
        echo "<script> alert('Password doesnot match!');document.location='adminSetting.php';</script>";
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
        echo "<script> alert('Password Changed!');document.location='adminSetting.php';</script>";
        die();
    }
}

if (isset($_POST['submit-image'])) {
    //profile Images files
    $images = $_FILES["userProfile"]["name"];
    $tmp_dir = $_FILES['userProfile']['tmp_name'];
    $imageSize = $_FILES['userProfile']['size'];

    $upload_dir = '../upload/profile/';
    $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png');
    $picProfile = rand(1000, 1000000) . "." . $imgExt;
    if (empty($images)) {
        echo "<script> alert('Nothing to Update');document.location='adminSetting.php';</script>";
    } elseif (!in_array($imgExt, $valid_extensions)) {
        echo "<script> alert('Only png,jpg,jpeg document allowed');document.location='adminSetting.php';</script>";
    } else {
        //move uploaded files to local drive
        move_uploaded_file($tmp_dir, $upload_dir . $picProfile);

        //insert into database
        $sql = "UPDATE user SET image = '$picProfile' WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'Profile Image Edited';
            $log_section = 'Edit Profile';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
        } else {
            echo $e->message();
        }
        echo "<script> alert('Profile Image Updated');document.location='adminSetting.php';</script>";
    }
}

if (isset($_POST['submit-document'])) {
    //user documents files upload
    $document = $_FILES['userDoc']['name'];
    $doc_tmp_dir = $_FILES['userDoc']['tmp_name'];
    $docSize = $_FILES['userDoc']['size'];

    $doc_upload_dir = '../upload/documents/';
    $docExt = strtolower(pathinfo($document, PATHINFO_EXTENSION));
    $valid_doc_extensions = array('pdf', 'docx', 'doc');
    $userDoc = rand(1000, 1000000) . "." . $docExt;
    if (empty($document)) {
        echo "<script> alert('Nothing to Update');document.location='adminSetting.php';</script>";
    } elseif (!in_array($docExt, $valid_doc_extensions)) {
        echo "<script> alert('Only pdf,doc,docx image allowed');document.location='adminSetting.php';</script>";
    } else {

        //move uploaded files to local drive
        move_uploaded_file($doc_tmp_dir, $doc_upload_dir . $userDoc);

        //insert into database
        $sql = "UPDATE user SET userDocument = '$userDoc' WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'User Document Edited';
            $log_section = 'Edit Profile';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
        } else {
            echo $e->message();
        }
        echo "<script> alert('User Document Updated');document.location='adminSetting.php';</script>";
    }
}

if (isset($_POST['submit'])) {


    //user details
    $fullname = $_POST['editFullname'];
    $contact = $_POST['editMobileno'];
    $email = $_POST['editEmail'];


    if ($fullname == $dbfullname && $contact == $dbcontact && $email == $dbemail) {
        echo "<script> alert('Nothing to Update');document.location='adminSetting.php';</script>";
    } elseif (!preg_match("/^[a-zA-z\s]*$/", $fullname)) {
        echo "<script> alert('Invalid name');document.location='adminSetting.php';</script>";
    } elseif (!preg_match("/^[0-9]*$/", $contact)) {
        echo "<script> alert('Invalid mobile number');document.location='adminSetting.php';</script>";
    } elseif (strlen($contact) != 10) {
        echo "<script> alert('Mobile number should be of 10 digits');document.location='adminSetting.php';</script>";
    } else {

        //insert into database
        $sql = "UPDATE user SET fullname = '$fullname',contact = '$contact', email = '$email' WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'User Profile Edited';
            $log_section = 'Edit Profile';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
        }
        echo "<script> alert('Updated');document.location='adminSetting.php';</script>";
        die();
    }
}
