<?php
if (isset($_POST['dateSubmit'])) {
    $from = $_POST['fromDate'];
    $to = $_POST['toDate'];

    $queryLog = "SELECT * FROM logs WHERE date BETWEEN '$from' AND '$to'";
    $stmtLog = $conn->prepare($queryLog);
    $stmtLog->execute();
    $rowcount = $stmtLog->rowCount();
    if ($rowcount > 0) {
        while ($rowLog = $stmtLog->fetch(PDO::FETCH_ASSOC)) {

?>
            <tr>
                <td><?php echo $rowLog['id']; ?></td>
                <td><?php echo $rowLog['section']; ?></td>
                <td><?php echo $rowLog['logs']; ?></td>
                <td><?php echo $rowLog['date']; ?></td>

            </tr>
<?php
        }
    } else {
        echo "<script>alert('No Result');</script>";
    }
} ?>