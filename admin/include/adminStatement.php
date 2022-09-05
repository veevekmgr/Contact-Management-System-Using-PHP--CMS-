<?php
include '../../include/topInclude.php';
$role = $_SESSION['ROLE'];
$userName = $_GET['username'];
if (isset($_SESSION['NAME']) && $role == 'admin') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Custom CSS-->
        <link rel="stylesheet" href="../../styles/userdashboard.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <title>Admin Statement</title>

        <!--Database Data fetch-->
        <?php include '../../include/dataFetch.php'; ?>

        <!-- Pagination -->
        <?php $perPage = 10;

        // Calculate Total pages
        $stmt = $conn->prepare("SELECT * FROM logs WHERE username = '$userName'");
        $total_results = $stmt->execute();
        $total_logs = $stmt->rowCount();
        $total_pages = ceil($total_logs / $perPage);

        // Current page
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $starting_limit = ($page - 1) * $perPage; ?>


    </head>

    <body>
        <!--Navbar-->
        <?php include '../../include/dashboardNavbar.php'; ?>
        <!--End of Navbar-->

        <!--Main-->
        <section class="main">

            <!--Sidebar Started-->
            <?php include '../include/adminSidebar.php'; ?>
            <!--Sidebar End-->

            <!--Main Content Start-->
            <div class="main--content">

                <!--Statement Section Started-->
                <div class="recent--statement">
                    <div class="title">
                        <h2 class="section--title">Statements</h2>
                        <form class="formDate" action="" method="POST">
                            <input type="date" name="fromDate" placeholder="">
                            <input type="date" name="toDate">

                            <input type="submit" value="Filter" name="dateSubmit">
                        </form>
                    </div>
                    <!--Statement Table -->

                    <div class="table">
                        <table>
                            <!--Table Heading-->
                            <thead>
                                <tr>
                                    <th>Statements</th>
                                    <th>Section</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <!--End of Table Heading-->
                            <tbody>
                                <!-- Search Date Filters -->
                                <?php
                                //Get date from form
                                if (isset($_POST['dateSubmit'])) {
                                    $from = $_POST['fromDate'];
                                    $to = $_POST['toDate'];

                                    //Query to get date from database
                                    $queryLog = "SELECT * FROM logs WHERE (date BETWEEN '$from' AND '$to') AND (username = '$userName')";
                                    $stmtLog = $conn->prepare($queryLog);
                                    $stmtLog->execute();
                                    $rowcount = $stmtLog->rowCount();

                                    //Check number of rows or data
                                    if ($rowcount > 0) {
                                        while ($rowLog = $stmtLog->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr>
                                                <td><?php echo $rowLog['section']; ?></td>
                                                <td><?php echo $rowLog['logs']; ?></td>
                                                <td><?php echo $rowLog['date']; ?></td>
                                            </tr>
                                    <?php
                                        } //End of WHile

                                        //if no data found
                                    } else {
                                        echo "<script>alert('No data found between dates!');document.location='adminStatement.php?username = " . $userName . "';</script>";
                                    }
                                    ?>
                            </tbody>
                        <?php } else { ?>
                            <tbody>
                                <?php
                                    //sql query to get data from database
                                    $sql_log = "SELECT * FROM logs WHERE username = '$userName' LIMIT $starting_limit,$perPage";
                                    $stmt_log = $conn->prepare($sql_log);
                                    $stmt_log->execute();

                                    while ($row_log = $stmt_log->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $row_log['section']; ?></td>
                                        <td><?php echo $row_log['logs']; ?></td>
                                        <td><?php echo $row_log['date']; ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        <?php } ?>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div id="pagination">
                        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>

                            <a href='<?php echo "?page=$page & username=$userName"; ?>'>
                                <?php echo $page; ?>
                            </a>

                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <!--Statement Section Ended-->
        </section>
        <!--Main Ended-->
        <?php include '../include/footer.php'; ?>
    </body>

    </html>
<?php } else {
    echo "<script>alert('You don't have permission to access this section!');document.location='login.php';</script>";
} ?>