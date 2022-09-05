<tbody>
    <?php
    // Search Data 
    if (isset($_POST['search'])) {
        $searchData = $_POST['search'];

        $min_length = 3;
        //Check search data length
        if (strlen($searchData) >= $min_length) {
            $searchData = htmlspecialchars($searchData);

            $stmt_sql = $conn->prepare("SELECT * FROM contact WHERE (contactname LIKE '%" . $searchData . "%') LIMIT $starting_limit,$perPage");
            $stmt_sql->execute();
            $row = $stmt_sql->rowCount();

            //Check how much data is available that has been searched
            if ($row > 0) {
                while ($row_Contacts = $stmt_sql->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                        <td><?php echo "<img src='../upload/Contact/profile/" . $row_Contacts['image'] . "' alt='user' class='img-contactUser'>"; ?></td>
                        <td><?php echo $row_Contacts['contactname']; ?></td>
                        <td><?php echo $row_Contacts['contactnumber']; ?><br>
                            <?php echo $row_Contacts['contactemail']; ?><br>
                            <?php echo $row_Contacts['address']; ?></td>

                        <td><?php echo $row_Contacts['date']; ?></td>
                        <td>
                            <a href='./viewContactDoc.php?username=<?php echo $row_Contacts['contactname']; ?>' class="btn-action btn-1">View Document</a>
                            <a href='./deleteContact.php?id=<?php echo $row_Contacts['id']; ?>' class="btn-action btn-2">Delete</a>
                            <a href='editContact.php?id=<?php echo $row_Contacts['id']; ?>' class="btn-action btn-3">Edit</a>
                        </td>
                    </tr>
        <?php  }
                //If no result found
            } else {
                echo "<script>alert('No result Found');document.location='contact.php';</script>";
            }

            //If character is less then 3 digits
        } else {
            echo "<script>alert('Search character should be greater than 3 digits.');document.location='contact.php';</script>";
        }

        //Default Table value
    } else { ?>
<tbody>
    <?php
        $sql_Contact = "SELECT * FROM contact WHERE username = '$username' LIMIT $starting_limit,$perPage";
        $stmt_Contact = $conn->prepare($sql_Contact);
        $stmt_Contact->execute();
        while ($row_Contact = $stmt_Contact->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>

            <td><?php echo "<img src='../upload/Contact/profile/" . $row_Contact['image'] . "' alt='user' class='img-contactUser'>"; ?></td>
            <td><?php echo $row_Contact['contactname']; ?></td>
            <td><?php echo $row_Contact['contactnumber'];  ?><br>
                <?php echo $row_Contact['contactemail']; ?><br>
                <?php echo $row_Contact['address']; ?></td>

            <td><?php echo $row_Contact['date']; ?></td>
            <?php $id = $row_Contact ?>
            <!-- <td><span><i class="ri-eye-line eye"></i><i class="ri-edit-line edit"></i><i class="ri-delete-bin-line delete"></i></span></td> -->
            <td>
                <a href='./viewContactDoc.php?username=<?php echo $row_Contact['contactname']; ?>' class="btn-action btn-1">View Document</a>
                <a href='./deleteContact.php?id=<?php echo $row_Contact['id']; ?>' class="btn-action btn-2">Delete</a>
                <a href='editContact.php?id=<?php echo $row_Contact['id']; ?>' class="btn-action btn-3">Edit</a>
            </td>
        </tr>
    <?php }
    ?>
</tbody>
<?php
    } ?>
</tbody>