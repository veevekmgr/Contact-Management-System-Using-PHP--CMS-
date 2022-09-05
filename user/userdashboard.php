<?php
include('../include/topInclude.php');

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

    </head>

    <body>
        <!--Navbar-->
        <?php include '../include/dashboardNavbar.php'; ?>

        <!--Main-->
        <section class="main">

            <!--Sidebar Started-->
            <?php include 'include/userSidebar.php'; ?>

            < <!--Main Content Start-->
                <div class="main--content">
                    <div class="overview">
                        <div class="title">
                            <h2 class="section--title">Welcome, <span style="color: red;"><?php echo $row['fullname']; ?></span></h2>
                        </div>

                        <!--Dashboard Cards-->
                        <?php include 'include/dashboardCard.php'; ?>
                    </div>

                    <!--Statement Section Started-->
                    <div class="recent--statement">
                        <div class="title">
                            <h2 class="section--title">Statements</h2>
                            <a href="statement.php">
                                <button class="btn-viewAll">View All</button>
                            </a>

                        </div>
                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Section</th>
                                        <th>Statements</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $sql_log = "SELECT * FROM logs ORDER BY id LIMIT $starting_limit,$perPage";
                                    $sql_log = "SELECT * FROM logs  WHERE username = '$username' ORDER BY username LIMIT 15";
                                    $stmt_log = $conn->prepare($sql_log);
                                    $stmt_log->execute();
                                    while ($row_log = $stmt_log->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row_log['section']; ?></td>
                                            <td><?php echo $row_log['logs']; ?></td>
                                            <td><?php echo $row_log['date']; ?></td>
                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

        </section>
        <!--Statement Section Ended-->
        <!--Main Ended-->
        <?php include '../include/footer.php'; ?>
    </body>

    </html>
<?php } else {
    echo "<script>alert('You can't access this section!');document.location='../login.php';</script>";
} ?>