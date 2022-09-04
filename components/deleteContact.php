<?php
include '../include/dbConn.php';
$conn = openConn();
$contactId = $_GET['id'];

$sql_contact = "SELECT * FROM contact WHERE id = '$contactId'";
$stmt_contact = $conn->prepare($sql_contact);
$stmt_contact->execute();
$row_contact = $stmt_contact->fetch(PDO::FETCH_ASSOC);

$sql_Delete = "DELETE FROM contact WHERE id = '$contactId'";
$stmt_Delete = $conn->prepare($sql_Delete);
$stmt_Delete->execute();

if ($stmt_Delete) {
    $log_msg = $row_contact['contactname'] . ' ' . 'Contact Deleted';
    $log_section = 'Contact Delete';
    $sql_log = "INSERT INTO logs(username,date,section,logs) VALUES ('$username',NOW(),'$log_section','$log_msg')";
    $stmt = $conn->prepare($sql_log);
    $stmt->execute();
    echo "<script> alert('Success');document.location='../addContact.php';</script>";
} else {
    $e->message();
}
echo "<script>alert('Deleted Successfully');document.location='../contact.php'</script>";
