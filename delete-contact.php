<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contacts";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['contactId'])) {
    $contactId = $_GET['contactId'];

    // Use prepared statement to avoid SQL injection
    $stmt = mysqli_prepare($conn, "DELETE FROM contacts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $contactId);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
