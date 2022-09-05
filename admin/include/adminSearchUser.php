<tbody>
    <?php
    // Search Data 
    if (isset($_POST['search'])) {
        $searchData = $_POST['search'];

        $min_length = 3;
        //Check search data length
        if (strlen($searchData) >= $min_length) {
            $searchData = htmlspecialchars($searchData);

            $stmt_sql = $conn->prepare("SELECT * FROM user WHERE (username LIKE '%" . $searchData . "%') LIMIT $starting_limit,$perPage");
            $stmt_sql->execute();
            $row = $stmt_sql->rowCount();

            //Check how much data is available that has been searched
            if ($row > 0) {
                while ($row_user = $stmt_sql->fetch(PDO::FETCH_ASSOC)) {
                    if ($row_user['role'] == 'user') { ?>
                        <tr>
                            <td><?php echo "<img src='../upload/profile/" . $row_user['image'] . "' alt='user' class='img-contactUser'>"; ?></td>
                            <td><?php echo $row_user['username']; ?></td>
                            <td><?php echo $row_user['fullname']; ?></td>
                            <td><?php echo $row_user['role']; ?></td>
                            <td><?php echo $row_user['contact']; ?><br>
                                <?php echo $row_user['email']; ?></td>
                            <td><?php echo $row_user['date']; ?></td>
                            <td>
                                <a href='include/viewDocument.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-1">View Document</a>
                                <a href='include/deleteUser.php?id=<?php echo $row_user['id']; ?>' class="btn-action btn-2">Delete User</a>
                                <a href='include/adminEditUser.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-3">Edit User</a>
                                <a href='include/adminStatement.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-1">View Statements</a>
                            </td>
                        </tr>
        <?php  }
                }
                //If no result found
            } else {
                echo "<script>alert('No result Found');document.location='adminUser.php';</script>";
            }

            //If character is less then 3 digits
        } else {
            echo "<script>alert('Search character should be greater than 3 digits.');document.location='adminUser.php';</script>";
        }

        //Default Table value
    } else { ?>

        <?php
        $sql_Contact = "SELECT * FROM user ORDER BY username LIMIT $starting_limit,$perPage";
        $stmt_Contact = $conn->prepare($sql_Contact);
        $stmt_Contact->execute();
        while ($row_user = $stmt_Contact->fetch(PDO::FETCH_ASSOC)) {
            if ($row_user['role'] == 'user') { ?>
                <tr>
                    <td><?php echo "<img src='../upload/profile/" . $row_user['image'] . "' alt='user' class='img-contactUser'>"; ?></td>
                    <td><?php echo $row_user['username']; ?></td>
                    <td><?php echo $row_user['fullname']; ?></td>
                    <td><?php echo $row_user['role']; ?></td>
                    <td><?php echo $row_user['contact']; ?><br>
                        <?php echo $row_user['email']; ?></td>
                    <td><?php echo $row_user['date']; ?></td>
                    <td>
                        <a href='include/viewDocument.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-1">View Document</a>
                        <a href='include/deleteUser.php?id=<?php echo $row_user['id']; ?>' class="btn-action btn-2">Delete User</a>
                        <a href='include/adminEditUser.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-3">Edit User</a>
                        <a href='include/adminStatement.php?username=<?php echo $row_user['username']; ?>' class="btn-action btn-1">View Statements</a>
                    </td>
                </tr>
        <?php }
        }
        ?>
</tbody>
<?php
    } ?>
</tbody>