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
        <title>Admin Dashboard</title>

        <!--Database Data fetch-->
        <?php include 'include/dataFetch.php'; ?>

    </head>

    <body>
        <!--Navbar-->
        <?php include 'include/dashboardNavbar.php'; ?>

        <!--Main-->
        <section class="main">

            <!--Sidebar Started-->
            <?php include 'include/adminSidebar.php'; ?>

            <!--Sidebar End-->

            <!--Main Content Start-->
            <div class="main--content">

                <div class="overview">
                    <div class="title">
                        <h2 class="section--title">Welcome, <span style="color: red;"><?php echo $row['fullname']; ?></span></h2>
                    </div>

                    <!--Dashboard Cards-->
                    <?php include 'include/adminDashCards.php'; ?>
                    <!--Dashboard Cards End-->
                </div>

                <!--Statement Section Started-->
                <div class="recent--statement">
                    <div class="title">
                        <h2 class="section--title">Users</h2>
                        <a href="statement.php">
                            <button class="btn-viewAll">View All</button>
                        </a>
                    </div>

                    <!--Table-->
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <!-- <th>S.N</th> -->
                                    <th>Image</th>
                                    <th>UserName</th>
                                    <th>Fullname</th>
                                    <th>Role</th>
                                    <th>Contacts</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Fetching User Data -->
                                <?php
                                $sql_user = "SELECT * FROM user ORDER BY username LIMIT 6";
                                $stmt_user = $conn->prepare($sql_user);
                                $stmt_user->execute();
                                while ($row_user = $stmt_user->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row_user['role'] == 'user') { ?>
                                        <tr>
                                            <!-- <td></td> -->
                                            <td><?php echo "<img src='upload/profile/" . $row_user['image'] . "' alt='user' class='img-contactUser'>"; ?></td>
                                            <td><?php echo $row_user['username']; ?></td>
                                            <td><?php echo $row_user['fullname']; ?></td>
                                            <td><?php echo $row_user['role']; ?></td>
                                            <td><?php echo $row_user['contact']; ?><br>
                                                <?php echo $row_user['email']; ?></td>
                                            <td><?php echo $row_user['date']; ?></td>
                                            <td>
                                                <a href='components/viewDocument.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-1">View Document</a>
                                                <a href='components/deleteUser.php?id=<?php echo $row_user['id']; ?>' class="btn-action btn-2">Delete User</a>
                                                <a href='adminEditUser.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-3">Edit User</a>
                                                <a href='./adminStatement.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-1">View Statements</a>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--Statement Section Ended-->
        </section>
        <!--Main Ended-->
        <script src="main.js"></script>
    </body>

    </html>
<?php } else {
    echo "<script> alert('No permission to enter this section');document.location='login.php';</script>";
} ?>