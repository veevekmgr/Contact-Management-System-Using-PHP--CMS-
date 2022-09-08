<?php
include '../include/topInclude.php';
$username = $_GET['username'];
$sql_check = "SELECT * FROM user WHERE username = '$username'";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->execute();
$result = $stmt_check->fetch(PDO::FETCH_ASSOC);
$dbfullname = $result['fullname'];
$dbemail = $result['email'];
$dbcontact = $result['contact'];


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
        echo "<script> alert('Nothing to Update');document.location='adminEditUser.php?username=$username';</script>";
    } elseif (!in_array($imgExt, $valid_extensions)) {
        echo "<script> alert('Only png,jpg,jpeg document allowed');document.location='adminEditUser.php?username=$username';</script>";
    } else {
        //move uploaded files to local drive
        move_uploaded_file($tmp_dir, $upload_dir . $picProfile);

        //insert into database
        $sql = "UPDATE user SET image = '$picProfile' WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'Profile Image Edited by Admin';
            $log_section = 'Edit Profile';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
            echo "<script> alert('Profile Image Updated');document.location='adminEditUser.php?username=$username';</script>";
        } else {
            echo $e->message();
        }
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
        echo "<script> alert('Nothing to Update');document.location='adminEditUser.php?username=$username';</script>";
        die();
    } elseif (!in_array($docExt, $valid_doc_extensions)) {
        echo "<script> alert('Only pdf,doc,docx image allowed');document.location='adminEditUser.php?username=$username';</script>";
    } else {

        //move uploaded files to local drive
        move_uploaded_file($doc_tmp_dir, $doc_upload_dir . $userDoc);

        //insert into database
        $sql = "UPDATE user SET userDocument = '$userDoc' WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'User Document Edited by Admin';
            $log_section = 'Edit Profile';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
            echo "<script> alert('User Document Updated');document.location='adminEditUser.php?username=$username';</script>";
            die();
        } else {
            echo $e->message();
        }
    }
}

if (isset($_POST['submit'])) {

    //user details
    $fullname = $_POST['editFullname'];
    $contact = $_POST['editMobileno'];
    $email = $_POST['editEmail'];


    if ($fullname == $dbfullname && $contact == $dbcontact && $email == $dbemail) {
        echo "<script> alert('Nothing to Update');document.location='adminEditUser.php?username=$username';</script>";
    } elseif (!preg_match("/^[a-zA-z\s]*$/", $fullname)) {
        echo "<script> alert('Invalid name');document.location='adminEditUser.php?username=$username';</script>";
    } elseif (!preg_match("/^[0-9]*$/", $contact)) {
        echo "<script> alert('Invalid mobile number');document.location='adminEditUser.php?username=$username';</script>";
    } elseif (strlen($contact) != 10) {
        echo "<script> alert('Mobile number should be of 10 digits');document.location='adminEditUser.php?username=$username';</script>";
    } else {

        //insert into database
        $sql = "UPDATE user SET fullname = '$fullname',contact = '$contact', email = '$email' WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'User Profile Edited by Admin';
            $log_section = 'Edit Profile';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
            echo "<script> alert('Updated');document.location='adminEditUser.php?username=$username';</script>";
            die();
        }
    }
}
