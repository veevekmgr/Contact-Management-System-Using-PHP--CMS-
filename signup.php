<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css " rel="stylesheet " id="bootstrap-css ">

    <!-- Custom CSS-->
    <link rel="stylesheet" href="styles/signup.css">

    <title>SignUp Page</title>

</head>

<body id="main">
    <?php include 'include/headerLogo.php'; ?>
    <section class="signup-block">
        <div class="container">
            <div class="row">
                <div class="col-md-5 banner-sec">
                    <img class="signupImg" src="images/signupImg.png" alt="">
                </div>
                <div class="col-md-7 signup-sec">
                    <h2 class="text-center">Create an Account</h2>

                    <!-- Signup Form -->
                    <form class="signup-form" name="signupForm" action="include/signUpAuth.php" onsubmit="return validation()" method="POST" enctype="multipart/form-data">
                        <div class="mt-3">
                            <label for="formFile" class="form-label" style="color: rgb(148, 145, 145) ; font-size: 2em;">Upload your Profile <span class="text-danger"> (*Only png,jpg & jpeg.)</span></label>
                            <input class="form-control" type="file" id="userProfile" name="userProfile">
                        </div>
                        <input type="text" id="user" name="username" class="form__input" placeholder="Username">
                        <input type="text" id="name" name="fullname" class="form__input" placeholder="Fullname">
                        <input type="email" id="email" name="email" class="form__input" placeholder="Email">
                        <input type="mobile" id="mobile" name="mobileno" class="form__input" placeholder="Mobile Number">
                        <input type="password" id="pass" name="password" class="form__input" placeholder="Password">
                        <input type="password" id="conpass" name="conpassword" class="form__input" placeholder="Confirm Password">
                        <div class="mt-4">
                            <label for="formFile" class="form-label" style="color: rgb(148, 145, 145) ; font-size: 2em;">Upload your Documents <span class="text-danger"> (*Only pdf,docx & docx.)</span></label>
                            <input class="form-control" type="file" id="userDoc" name="userDoc">
                        </div>

                        <div class="form-check">
                            <input type="submit" name="submit" value="Sign Up" class="btn btn-login">
                        </div>
                    </form>
                    <div class=" text-center account">
                        <span>Already have an account? <a href="login.php"><Label style="color: #2ccd59;"><u>Login Now!</u></Label></a> </span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Footer PHP-->
    <?php include 'include/footer.php'; ?>

    <!--Login Authentication-->
    <script src="script/loginValidation.js"></script>
</body>

</html>