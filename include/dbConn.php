<?php
// config files
function OpenConn()
{
    $conn = new PDO('mysql:host=localhost;dbname=cms;', 'root', '') or die("Connection Failed: %s\n" . $conn->error);

    return $conn;
}

function CloseConn($conn)
{
    $conn->close();
}
