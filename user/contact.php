<?php
include '../include/topInclude.php';

if (isset($_SESSION['NAME']) && $_SESSION['ROLE'] == 'user') {
    $username = $_SESSION['NAME'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Custom CSS-->
        <link rel="stylesheet" href="../styles/userdashboard.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <title>Dashboard</title>

        <!--Database Data fetch-->
        <?php include '../include/dataFetch.php'; ?>

        <!-- Pagination -->
        <?php $perPage = 10;

        // Calculate Total pages
        $stmt = $conn->query('SELECT count(id) FROM contact');
        $total_results = $stmt->fetchColumn();
        $total_pages = ceil($total_results / $perPage);

        // Current page
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $starting_limit = ($page - 1) * $perPage; ?>

    </head>

    <body>
        <!--Navbar-->
        <?php include '../include/dashboardNavbar.php'; ?>
        <!--End of Navbar-->

        <!--Main-->
        <section class="main">

            <!--Sidebar Started-->
            <?php include 'include/userSidebar.php'; ?>
            <!--Sidebar End-->

            <!--Main Content Start-->
            <div class="main--content">

                <!--Statement Section Started-->
                <div class="recent--statement">
                    <div class="title">
                        <h2 class="section--title">Contacts</h2>
                        <form method="POST" action="" class="search">
                            <input type="text" name="search" placeholder="Search Username..">
                            <button type="submit"><i class="ri-search-2-line"></i></button>
                        </form>

                    </div>
                    <!-- Table Heading/Table -->
                    <div class="contact--table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>FullName</th>
                                    <th>Contact</th>
                                    <th>Added Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php include 'include/search.php'; ?>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <?php include '../components/pagination.php'; ?>
                </div>
            </div>
            <!--Statement Section Ended-->
        </section>
        <!--Main Ended-->

        <?php include '../include/footer.php'; ?>

    </body>

    </html>
<?php } else {
    echo "<script>alert('You can't access this section!');document.location='../login.php';</script>";
} ?>