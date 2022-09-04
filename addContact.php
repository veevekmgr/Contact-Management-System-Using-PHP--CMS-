<?php
include 'include/dbConn.php';
$conn = openConn();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Custom CSS-->
    <link rel="stylesheet" href="styles/userdashboard.css">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css " rel="stylesheet " id="bootstrap-css ">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--Database Data fetch-->
    <?php include 'include/dataFetch.php'; ?>

<body>
    <!--Navbar-->
    <?php include 'include/dashboardNavbar.php'; ?>

    <!--Main-->
    <section class="main">

        <!--Sidebar Started-->
        <?php include 'include/userSidebar.php'; ?>


        <div class="main--content">
            <div class="addContact-container">
                <div class="row">
                    <div class="addContact-sec">
                        <h2 class="text-center">Add a Contact</h2>

                        <!-- addContact Form -->
                        <form class="addContact-form" name="addContactForm" action="include/addContactForm.php" method="POST" enctype="multipart/form-data">
                            <div class="mt-3">
                                <label for="formFile" class="form-label" style="color: rgb(148, 145, 145) ; font-size: 2em;">Upload Profile Picture<span class="text-danger"> (*Only png,jpg & jpeg.)</span></label>
                                <input class="form-control" type="file" id="userProfile" name="userProfile">
                            </div>
                            <input type="text" id="name" name="name" class="form__input" placeholder="Fullname">
                            <input type="email" id="email" name="email" class="form__input" placeholder="Email">
                            <input type="text" id="address" name="address" class="form__input" placeholder="Address">
                            <input type="mobile" id="mobile" name="mobileno" class="form__input" placeholder="Mobile Number">
                            <div class="mt-4">
                                <label for="formFile" class="form-label" style="color: rgb(148, 145, 145) ; font-size: 2em;">Upload Documents (National Identity)<span class="text-danger" style="font-size: 0.6em;"> (*Only pdf,docx & docx.)</span></label>
                                <input class="form-control" type="file" id="userDoc" name="userDoc">
                            </div>

                            <div class="form-check">
                                <input type="submit" name="submit" value="Add" class="btn btn-Add">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--Main Ended-->

        <?php include 'include/footer.php'; ?>

        <script src="main.js"></script>

</body>

</html>