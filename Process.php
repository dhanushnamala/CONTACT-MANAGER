<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contacts";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $locality = $_POST["locality"];

    $sql = "INSERT INTO contacts (name, mobile, email, gender, locality) VALUES (UPPER('$name'), '$mobile', '$email', '$gender', '$locality')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to success.php
        header("Location: success.php");
        exit; // Ensure that no other code is executed after the header redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
