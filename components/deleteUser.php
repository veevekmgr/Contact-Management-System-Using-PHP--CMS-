<?php
include '../topInclude.php';
$username = $_SESSION['NAME'];
echo $username;
$userId = $_GET['id'];

$sql_user = "SELECT * FROM user WHERE id = '$userId'";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->execute();
$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

$sql_Delete = "DELETE FROM user WHERE id = '$userId'";
$stmt_Delete = $conn->prepare($sql_Delete);
$stmt_Delete->execute();

if ($stmt_Delete) {
    $del_username = $row_user['username'];
    $sql_LogDelete = "DELETE FROM logs WHERE username = '$del_username'";
    $stmt_LogDelete = $conn->prepare($sql_LogDelete);
    $stmt_LogDelete->execute();

    $sql_ContactDelete = "DELETE FROM contact WHERE username = '$del_username'";
    $stmt_ContactDelete = $conn->prepare($sql_ContactDelete);
    $stmt_ContactDelete->execute();

    $log_msg = $row_user['username'] . ' ' . 'User Deleted';
    $log_section = 'User Delete';
    $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
    $stmt = $conn->prepare($sql_log);
    $stmt->execute();
    echo "<script>alert('Deleted Successfully');document.location='../adminDashboard.php'</script>";
} else {
    $e->message();
}
