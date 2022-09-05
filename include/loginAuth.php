<?php
//Database Connection

include 'dbConn.php';
$conn = OpenConn();
session_start();
//echo "Connected";

//Once login button is clicked on form
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //Checking database
    $query = "SELECT * FROM user WHERE username = '$username'";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $dbPass = $result['password'];
    //Checking whether username and password is empty or not!
    if (!empty($username) || !empty($password)) {

        //checking whether password match with database
        if ($dbPass == $password) {
            $role = $result['role'];
            $_SESSION['ID'] = $result['id'];
            $_SESSION['ROLE'] = $result['role'];
            $_SESSION['NAME'] = $result['username'];
            $_SESSION['PASSWORD'] = $result['password'];
            $msg = 'Welcome';
            if ($role == 'admin') {
                echo "<script>alert('Login Succes');document.location='../admin/adminDashboard.php';</script>";
                die();
            } else {
                echo "<script>alert('Login Succes');document.location='../user/userdashboard.php';</script>";
                die();
            }
        } else {
            echo "<script>alert('Incorrect Password');document.location='../login.php';</script>";
            die();
        }
    } else {
        echo "<script>alert('Password field is empty!');document.location='../login.php';</script>";
        die();
    }
}
