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
                    $queryLog = "SELECT * FROM logs WHERE date BETWEEN '$from' AND '$to' AND (username = '$username')";
                    $stmtLog = $conn->prepare($queryLog);
                    $stmtLog->execute();
                    $rowcount = $stmtLog->rowCount();

                    //Check number of rows or data
                    if ($rowcount > 0) {
                        while ($rowLog = $stmtLog->fetch(PDO::FETCH_ASSOC)) {

                ?>
                           <tr>
                               <td><?php echo $rowLog['section']; ?></td>
                               <td><?php echo $rowLog['logs']; ?></td>
                               <td><?php echo $rowLog['date']; ?></td>
                           </tr>
                   <?php
                        } //End of WHile

                        //if no data found
                    } else {
                        echo "<script>alert('No data found between dates!');document.location='statement.php';</script>";
                    }
                    ?>
           </tbody>
       <?php } else { ?>
           <tbody>
               <?php
                    //sql query to get data from database
                    $sql_log = "SELECT * FROM logs WHERE username = '$username' LIMIT $starting_limit,$perPage";
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
       <?php } ?>
       </table>
   </div>