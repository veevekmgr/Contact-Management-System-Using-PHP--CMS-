 <?php
    //logout.php  
    session_start();

    //Session destroyed
    session_destroy();

    //Navigate to login page
    echo "<script>alert('You have logout!');document.location='../login.php';</script>";
    // header("location:../login.php");
    ?>  