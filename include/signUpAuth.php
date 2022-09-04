<?php
try {
    //Database Connection
    include 'dbConn.php';
    $conn = OpenConn();

    if (isset($_POST['submit'])) {

        //profile Images files
        $images = $_FILES["userProfile"]["name"];
        $tmp_dir = $_FILES['userProfile']['tmp_name'];
        $imageSize = $_FILES['userProfile']['size'];

        $upload_dir = '../upload/profile/';
        $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');
        $picProfile = rand(1000, 1000000) . "." . $imgExt;


        //user documents files upload
        $document = $_FILES['userDoc']['name'];
        $doc_tmp_dir = $_FILES['userDoc']['tmp_name'];
        $docSize = $_FILES['userDoc']['size'];

        $doc_upload_dir = '../upload/documents/';
        $docExt = strtolower(pathinfo($document, PATHINFO_EXTENSION));
        $valid_doc_extensions = array('pdf', 'docx', 'doc');
        $userDoc = rand(1000, 1000000) . "." . $docExt;

        //user details
        $fullname = $_POST['fullname'];
        $contact = $_POST['mobileno'];
        $email = $_POST['email'];
        $role = 'user';
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $conPass = md5($_POST['conpassword']);
        //$vkey = md5(time() . $username);


        //Validations
        $query = "SELECT username FROM user WHERE username='$username'";
        $result = $conn->prepare($query);
        $result->execute();
        $count = $result->rowCount();
        if ($count > 0) {
            header('Location: ../signup.php?msg=Username Already Taken');
        } elseif (!in_array($docExt, $valid_doc_extensions)) {
            header('Location: ../signup.php?msg=Only image extension allowed document');
        } elseif (!in_array($imgExt, $valid_extensions)) {
            header('Location: ../signup.php?msg=Only image extension allowed');
        } elseif (strlen($username) < 5) {
            header('Location: ../signup.php?msg=Username too short');
        } elseif ($password != $conPass) {
            header('Location: ../signup.php?msg=Password not matched');
        } elseif (strlen($password) < 8) {
            header('Location: ../signup.php?msg=Password should be of 8 digits.');
        } elseif (!preg_match("/^[a-zA-z\s]*$/", $fullname)) {
            header('Location: ../signup.php?msg=Special characters or number not allowed');
        } elseif (!preg_match("/^[0-9]*$/", $contact)) {
            header('Location: ../signup.php?msg=Only number allowed ');
        } elseif (strlen($contact) != 10) {
            header(' Location: ../signup.php?msg=Number should be 10 digits.');
        } else {

            //move uploaded files to local drive
            move_uploaded_file($tmp_dir, $upload_dir . $picProfile);
            move_uploaded_file($doc_tmp_dir, $doc_upload_dir . $userDoc);

            //insert into database
            $sql = "INSERT INTO user(username,password,role,image,fullname,contact,email,userDocument,date) VALUES ('$username', '$password' ,'$role','$picProfile','$fullname','$contact','$email','$userDoc', NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute();


            //Check query 
            if ($stmt) {
                $log_msg = $username . ' ' . 'New Acoount Created';
                $log_section = 'New Account';
                $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
                $stmt = $conn->prepare($sql_log);
                $stmt->execute();
                echo "<script> alert('Success');document.location='../signup.php';</script>";
            } else {
                $e->message();
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
