<?php
try {
    //Database Connection
    include '../../include/topInclude.php';


    if (isset($_POST['submit'])) {

        //profile Images files
        $images = $_FILES["userProfile"]["name"];
        $tmp_dir = $_FILES['userProfile']['tmp_name'];
        $imageSize = $_FILES['userProfile']['size'];

        $upload_dir = '../../upload/Contact/profile/';
        $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');
        $picProfile = rand(1000, 1000000) . "." . $imgExt;


        //user documents files upload
        $document = $_FILES['userDoc']['name'];
        $doc_tmp_dir = $_FILES['userDoc']['tmp_name'];
        $docSize = $_FILES['userDoc']['size'];

        $doc_upload_dir = '../../upload/Contact/documents/';
        $docExt = strtolower(pathinfo($document, PATHINFO_EXTENSION));
        $valid_doc_extensions = array('pdf', 'docx', 'doc');
        $userDoc = rand(1000, 1000000) . "." . $docExt;

        //user details
        $username = $_SESSION['NAME'];
        $fullname = $_POST['name'];
        $contact = $_POST['mobileno'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        //$vkey = md5(time() . $username);


        //Validations
        // $query = "SELECT username FROM contact WHERE contactname='$fullname'";
        // $result = $conn->prepare($query);
        // $result->execute();
        // $count = $result->rowCount();
        if (empty($fullname) || empty($address) || empty($contact) || empty($email) || empty($picProfile) || empty($userDoc)) {
            echo "<script> alert('Field cannot be empty');document.location='../addContact.php';</script>";
        } elseif (!in_array($docExt, $valid_doc_extensions)) {
            echo "<script> alert('Only jpg,png,jpeg image allowed');document.location='../addContact.php';</script>";
        } elseif (!in_array($imgExt, $valid_extensions)) {
            echo "<script> alert('Only pdf,doc,docx document allowed');document.location='../addContact.php';</script>";
        } else {

            //move uploaded files to local drive
            move_uploaded_file($tmp_dir, $upload_dir . $picProfile);
            move_uploaded_file($doc_tmp_dir, $doc_upload_dir . $userDoc);

            //insert into database
            $sql = "INSERT INTO contact(username,contactname,contactemail,contactnumber,address,image,document,date) VALUES ('$username','$fullname','$email','$contact','$address','$picProfile','$userDoc', NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            //Check query 
            if ($stmt) {
                $log_msg = $fullname . ' ' . 'Contact Added';
                $log_section = 'New Contact';
                $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
                $stmt = $conn->prepare($sql_log);
                $stmt->execute();
                echo "<script> alert('Success');document.location='../addContact.php';</script>";
            } else {
                $e->message();
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
