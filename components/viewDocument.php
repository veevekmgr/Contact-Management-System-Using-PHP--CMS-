<?php
include '../topInclude.php';
$userName = $_GET['username'];

//Fetch Document
$sql_doc = "SELECT * FROM user WHERE username = '$userName'";
$stmt_doc = $conn->prepare($sql_doc);
$stmt_doc->execute();
$row = $stmt_doc->fetch(PDO::FETCH_ASSOC);
$doc = $row['userDocument'];
$doc_tmp = pathinfo($doc, PATHINFO_EXTENSION);

if ($doc_tmp == "pdf") {
   // Download document files
   header('Content-Type: application/pdf');
   header('Content-Disposition: attachment; filename="' . $doc . '"');
   ob_clean();
   ob_end_flush();
   readfile('../upload/documents/' . $doc);
} elseif ($doc_tmp == "doc" || $doc_tmp == "docx") {
   header('Content-Type: application/msword');
   header('Content-Disposition: attachment; filename="' . $doc . '"');
   ob_clean();
   ob_end_flush();
   readfile('../upload/documents/' . $doc);
} else {
   echo "<script>alert('No result Found');document.location='adminUser.php';</script>";
}
?>

</div>