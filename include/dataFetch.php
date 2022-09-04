<?php
//Data Fetch From user Table
$username = $_SESSION['NAME'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sql_logs = "SELECT * FROM logs WHERE username = '$username'";
$stmt_logs = $conn->prepare($sql_logs);
$stmt_logs->execute();
// $row_logs = $stmt_log->fetch(PDO::FETCH_ASSOC);

$sql_contact = "SELECT * FROM contact WHERE username = '$username'";
$stmt_contact = $conn->prepare($sql_contact);
$stmt_contact->execute();
$row_contact = $stmt_contact->fetch(PDO::FETCH_ASSOC);
$row_count = $stmt_contact->rowCount();
