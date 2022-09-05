<?php
include '../../include/topInclude.php';
$id = $_GET['id'];
$username = $_SESSION['NAME'];
$sql_check = "SELECT * FROM contact WHERE id = '$id'";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->execute();
$result = $stmt_check->fetch(PDO::FETCH_ASSOC);
$dbfullname = $result['contactname'];
$dbemail = $result['contactemail'];
$dbcontact = $result['contactnumber'];
$dbaddress = $result['address'];

if (isset($_POST['submit-image'])) {
    //profile Images files
    $images = $_FILES["userProfile"]["name"];
    $tmp_dir = $_FILES['userProfile']['tmp_name'];
    $imageSize = $_FILES['userProfile']['size'];

    $upload_dir = '../../upload/profile/';
    $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png');
    $picProfile = rand(1000, 1000000) . "." . $imgExt;
    if (empty($images)) {
        echo "<script> alert('Nothing to Update');document.location='../editContact.php?id=$id';</script>";
    } else {
        //move uploaded files to local drive
        move_uploaded_file($tmp_dir, $upload_dir . $picProfile);

        //insert into database
        $sql = "UPDATE contact SET image = '$picProfile' WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'Contact Image Edited';
            $log_section = 'Edit Contact';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
            echo "<script> alert('Contact Image Updated');document.location='../editContact.php?id=$id';</script>";
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

    $doc_upload_dir = '../../upload/documents/';
    $docExt = strtolower(pathinfo($document, PATHINFO_EXTENSION));
    $valid_doc_extensions = array('pdf', 'docx', 'doc');
    $userDoc = rand(1000, 1000000) . "." . $docExt;
    if (empty($document)) {
        echo "<script> alert('Nothing to Update');document.location='../editContact.php?id=$id';</script>";
        die();
    } else {

        //move uploaded files to local drive
        move_uploaded_file($doc_tmp_dir, $doc_upload_dir . $userDoc);

        //insert into database
        $sql = "UPDATE contact SET document = '$userDoc' WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'Contact Document Edited';
            $log_section = 'Edit Contact Document';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
            echo "<script> alert('User Document Updated');document.location='../editContact.php?id=$id';</script>";
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
    $address = $_POST['editAddress'];


    if ($fullname == $dbfullname && $contact == $dbcontact && $email == $dbemail) {
        echo "<script> alert('Nothing to Update');document.location='../editContact.php?id=$id';</script>";
    } else {

        //insert into database
        $sql = "UPDATE contact SET contactname = '$fullname',contactnumber = '$contact', contactemail = '$email', address = '$address' WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $log_msg = $username . ' ' . 'Contact Profile Edited';
            $log_section = 'Edit Contact Profile';
            $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
            $stmt = $conn->prepare($sql_log);
            $stmt->execute();
            echo "<script> alert('Updated');document.location='../editContact.php?id=$id';</script>";
            die();
        }
    }
}
