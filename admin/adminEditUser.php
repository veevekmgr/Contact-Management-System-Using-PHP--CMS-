<?php
include '../include/topInclude.php'; ?>
<?php $userName = $_GET['username'];

if (isset($_SESSION['NAME']) && $_SESSION['ROLE'] == 'admin') {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Custom CSS-->
        <link rel="stylesheet" href="../styles/userdashboard.css">

        <!-- Bootstrap CSS -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css " rel="stylesheet " id="bootstrap-css ">

        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <!--Database Data fetch-->
        <?php include '../include/dataFetch.php'; ?>

        <title>Edit User</title>

    </head>
    <!--Navbar-->
    <?php include '../include/dashboardNavbar.php'; ?>

    <!--Main-->
    <section class="main">

        <!--Sidebar Started-->
        <?php include 'adminSidebar.php'; ?>

        <div class="main--content">
            <div class="title">
                <h2 class="section--title">Edit User</h2>
            </div>
            <div class="passwordForm">
                <h2>Change Password</h2>
                <div class="container">


                    <!-- Change Password Form -->
                    <form action="adminChangePassword.php?username=<?php echo $userName; ?>" method="POST" class="addContact">
                        <input type="password" id="newpass" name="newPassword" class="form__input" placeholder="New Password" required>
                        <input type="password" id="conpass" name="conPassword" class="form__input" placeholder="Confirm Password" required>
                        <div class="form-check">
                            <input type="submit" name="submit" value="Change" class="btn btn-Add">
                        </div>
                    </form>

                </div>
            </div>

            <div class="passwordForm">
                <h2>Update Image and Document </h2>
                <div class="container">
                    <form action="adminEditProfile.php?username=<?php echo $userName; ?>" method="POST" class="addContact" enctype="multipart/form-data">
                        <?php
                        $username = $_SESSION['NAME'];

                        $sql_fetchData = "SELECT * FROM USER WHERE username = '$username'";
                        $stmt_fetchData = $conn->prepare($sql_fetchData);
                        $stmt_fetchData->execute();
                        $result_fetchData = $stmt_fetchData->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="mt-3">
                            <label for="formFile" class="form-label" style="color: rgb(148, 145, 145) ; font-size: 1.5em; margin-top: 4px;">Update your Profile <span class="text-danger" style="font-size: 0.8em;"> (*Only png,jpg & jpeg.)</span></label>
                            <input class="form-control" type="file" id="userProfile" name="userProfile" value="">
                        </div>
                        <div class="form-check">
                            <input type="submit" name="submit-image" value="Update" class="btn btn-Add">
                        </div>

                        <div class=" mt-4">
                            <label for="formFile" class="form-label" style="color: rgb(148, 145, 145) ; font-size: 1.5em;">Update your Documents <span class="text-danger" style="font-size: 0.8em;"> (*Only pdf,docx & docx.)</span></label>
                            <input class="form-control" type="file" id="userDoc" name="userDoc" value="">
                        </div>

                        <div class="form-check">
                            <input type="submit" name="submit-document" value="Update" class="btn btn-Add">
                        </div>

                    </form>

                </div>
            </div>

            <div class="editUserForm">
                <h2>Edit Details</h2>
                <div class="container">
                    <form action="adminEditProfile.php?username=<?php echo $userName; ?>" method="POST" class="addContact" enctype="multipart/form-data">
                        <?php
                        $username = $_GET['username'];

                        $sql_fetchData = "SELECT * FROM USER WHERE username = '$username'";
                        $stmt_fetchData = $conn->prepare($sql_fetchData);
                        $stmt_fetchData->execute();
                        $result_fetchData = $stmt_fetchData->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <input type="text" id="name" name="editFullname" class="form__input" value="<?php echo $result_fetchData['fullname']; ?>" required>
                        <input type="email" id="email" name="editEmail" class="form__input" value="<?php echo $result_fetchData['email']; ?>" required>
                        <input type="mobile" id="mobile" name="editMobileno" class="form__input" value="<?php echo $result_fetchData['contact']; ?>" required>

                        <div class="form-check">
                            <input type="submit" name="submit" value="Update" class="btn btn-Add">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <?php include '../include/footer.php'; ?>
        </body>

    </html>

<?php } else {
    echo "<script> alert('No permission to enter this section');document.location='../login.php';</script>";
} ?>