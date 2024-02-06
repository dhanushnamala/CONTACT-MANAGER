<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #CDF5FD;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .contact-details {
            display: flex;
            justify-content: space-between;
        }

        .contact-name {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .contact-info {
            flex-grow: 1;
        }

        .info-item {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Details</h1>

        <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "contacts";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get contact ID from the query parameter
    $contactId = isset($_GET['contactId']) ? $_GET['contactId'] : 1;

    // Use prepared statements for security
    $stmt = $conn->prepare("SELECT * FROM `contacts` WHERE `id` = ?");
    $stmt->bind_param("i", $contactId);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="contact-details">
            <div class="contact-info">
                <div class="info-item">
                    <label for="name">Name:</label>
                    <p class="contact-name"><?php echo $row['name']; ?></p>
                </div>
                <div class="info-item">
                    <label for="email">Email:</label>
                    <p><?php echo $row['email']; ?></p>
                </div>
                <div class="info-item">
                    <label for="mobile">Mobile Number:</label>
                    <p><?php echo $row['mobile']; ?></p>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo '<p>Contact not found</p>';
    }

    $stmt->close();
    $conn->close();
?>

    </div>
</body>
</html>
