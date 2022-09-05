 <?php include '../include/topInclude.php';
    $userName = $_GET['username'];

    $sql_doc = "SELECT * FROM contact WHERE contactname = '$userName'";
    $stmt_doc = $conn->prepare($sql_doc);
    $stmt_doc->execute();
    $row = $stmt_doc->fetch(PDO::FETCH_ASSOC);
    $doc = $row['document'];
    $doc_tmp = pathinfo($doc, PATHINFO_EXTENSION);

    if ($doc_tmp == "pdf") {
        // Download document files
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $doc . '"');
        ob_clean();
        ob_end_flush();
        readfile('../upload/Contact/documents/' . $doc);
    } elseif ($doc_tmp == "doc" || $doc_tmp == "docx") {
        header('Content-Type: application/msword');
        header('Content-Disposition: attachment; filename="' . $doc . '"');
        ob_clean();
        ob_end_flush();
        readfile('../upload/Contact/documents/' . $doc);
    } else {
        echo "<script>alert('No result Found');document.location='./contact.php';</script>";
    }
    ?>
 </div>