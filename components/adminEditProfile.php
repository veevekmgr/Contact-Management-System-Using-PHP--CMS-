<?php
include '../topInclude.php';
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
        echo "<script> alert('Nothing to Update');document.location='../adminDashboard.php';</script>";
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
            echo "<script> alert('Profile Image Updated');document.location='../adminDashboard.php';</script>";
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
        echo "<script> alert('Nothing to Update');document.location='../adminDashboard.php';</script>";
        die();
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
            echo "<script> alert('User Document Updated');document.location='../adminDashboard.php';</script>";
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
        echo "<script> alert('Nothing to Update');document.location='../adminDashboard.php';</script>";
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
            echo "<script> alert('Updated');document.location='../adminDashboard.php';</script>";
            die();
        }
    }
}
