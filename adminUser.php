<?php
include 'topInclude.php';

$role = $_SESSION['ROLE'];

if ($role == 'admin') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Custom CSS-->
        <link rel="stylesheet" href="styles/userdashboard.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <title>User</title>

        <!--Database Data fetch-->
        <?php include 'include/dataFetch.php'; ?>

        <!-- Pagination -->
        <?php $perPage = 10;

        // Calculate Total pages
        $stmt = $conn->query('SELECT count(id) FROM user');
        $total_results = $stmt->fetchColumn();
        $total_pages = ceil($total_results / $perPage);

        // Current page
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $starting_limit = ($page - 1) * $perPage; ?>


    </head>

    <body>
        <!--Navbar-->
        <?php include 'include/dashboardNavbar.php'; ?>
        <!--End of Navbar-->

        <!--Main-->
        <section class="main">

            <!--Sidebar Started-->
            <?php include 'include/adminSidebar.php'; ?>
            <!--Sidebar End-->

            <!--Main Content Start-->
            <div class="main--content">

                <!--Statement Section Started-->
                <div class="recent--statement">
                    <div class="title">
                        <h2 class="section--title">User</h2>
                        <form method="POST" action="" class="search">
                            <input type="text" name="search" placeholder="Search Username..">
                            <button type="submit"><i class="ri-search-2-line"></i></button>
                        </form>
                    </div>
                    <!--Statement Table -->
                    <div class="contact--table">
                        <table>
                            <thead>
                                <tr>
                                <tr>
                                    <th>Image</th>
                                    <th>UserName</th>
                                    <th>Fullname</th>
                                    <th>Role</th>
                                    <th>Contacts</th>
                                    <th>Date</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <?php include 'components/adminSearchUser.php'; ?>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <?php include 'components/pagination.php'; ?>
                </div>
            </div>
            <!--Statement Section Ended-->
        </section>
        <!--Main Ended-->
        <script src="main.js"></script>
    </body>

    </html>
<?php } else {
    //echo "<script> alert('No permission to enter this section');document.location='login.php';</script>";
} ?>