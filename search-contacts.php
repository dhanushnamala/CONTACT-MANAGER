<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contacts";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'];

$sql = "SELECT * FROM contacts WHERE UPPER(name) LIKE UPPER('$search%') OR mobile LIKE '%$search%' ORDER BY name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li class="contact">';
        echo '<div class="contact-name">' . $row['name'] . '</div>';
        echo '<div class="icons">';
        echo '<a href="Card.php?contactId=' . $row['id'] . '" class="message-icon">&#9993;</a>';
        echo '<span class="delete-icon" onclick="deleteContact(' . $row['id'] . ')">&#10006;</span>';
        echo '</div>';
        echo '</li>';
    }
} else {
    echo '<li>No matching contacts found</li>';
}

$conn->close();
?>
