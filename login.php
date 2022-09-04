   <?php include 'include/loginAuth.php' ?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">

       <!-- Bootstrap CSS -->

       <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css " rel="stylesheet " id="bootstrap-css ">
       <link rel="stylesheet" href="styles/login.css">
       <title>Login Page</title>

   </head>

   <body id="main">
       <?php include 'include/headerLogo.php'; ?>
       <section class="login-block">
           <div class="container">
               <div class="row">
                   <div class="col-md-5 banner-sec">
                       <img class="loginImg" src="images/loginImage.png" alt="">
                   </div>
                   <div class="col-md-7 login-sec">
                       <h2 class="text-center">Login</h2>

                       <form class="login-form" name="loginForm" action="include/loginAuth.php" onsubmit="return validation()" method="POST">
                           <input type="text" id="user" name="username" id="username" class="form__input" placeholder="Username">
                           <input type="password" id="pass" name="password" id="password" class="form__input" placeholder="Password">

                           <a href="#"><label style="float: right;"><u>Forgot Password?</u></label></a>

                           <div class="form-check">
                               <input type="submit" name="submit" value="Login" class="btn btn-login">
                           </div>

                       </form>
                       <div class=" text-center account">
                           <span>New User? <a href="signup.php"><Label style="color: #2ccd59;"><u>Register Now!</u></Label></a> </span>
                       </div>
                   </div>

               </div>
           </div>
       </section>
       <!--Footer PHP-->
       <?php include 'include/footer.php' ?>

       <!--Login Authentication-->
       <script src="script/loginValidation.js"></script>
   </body>

   </html>