<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="\icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-...", crossorigin="anonymous" />
    <title>Contact List</title>
    <style>
        body {
            background-image("C:\xampp\htdocs\BingImageOfTheDay: .jpeg");
            font-family: 'Arial', sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
        }


        h1 {
            text-align: center;
            font-weight: bold;
            color: white; 
        }

        .contact-list, #search-results {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .contact, #search-results .contact {
            background-color:#CDF5FD ;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contact-name, #search-results .contact-name {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .icons, #search-results .icons {
            display: flex;
            justify-content: space-around;
        }

        .message-icon, .delete-icon, #search-results .message-icon, #search-results .delete-icon {
            font-size: 20px;
            cursor: pointer;
            color: #333;
        }

        .message-icon:hover, #search-results .message-icon:hover {
            color: #007bff;
        }

        .delete-icon:hover, #search-results .delete-icon:hover {
            color: #dc3545;
        }

        .add-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #search-form {
            margin-top: 20px;
            text-align: center;
        }

        label {
            margin-right: 10px;
        }

        #search-input {
            padding: 10px;
            font-size: 14px;
        }

        button {
            padding: 8px 12px;
            font-size: 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Contact List</h1>

    <a href="Contact.htm" class="add-button">Add Contact</a>

    <!-- Search Form -->
    <form id="search-form">
        <label for="search-input"><b style="font-size:20px;"><u>Search:</u></b></label>
        <input type="text" id="search-input" name="search" placeholder="Enter name or mobile number">
        <button type="button" onclick="searchContacts()">Search</button>
    </form>

    <ul class="contact-list">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "contacts";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM contacts order by name";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="contact">';
            echo '<div class="contact-name">' . $row['name'] . '</div>';
            echo '<div class="icons">';
            echo '<a href="Card.php?contactId=' . $row['id'] . '" class="message-icon">&#9993;</a>';
            echo '<span class="delete-icon" onclick="deleteContact(' . $row['id'] . ')">&#x2716;</span>';
            echo '</div>';
            echo '</li>';
        }
    } else {
        echo '<li>No contacts available</li>';
    }

    mysqli_close($conn);
?>

    </ul>

    <ul id="search-results"></ul>

    <script>
        document.querySelectorAll('.contact').forEach(function(contact) {
            contact.addEventListener('click', function() {
                var contactName = this.querySelector('.contact-name').innerText;
                // You can do something with the contactName if needed
            });
        });

        function deleteContact(contactId) {
            if (confirm("Are you sure you want to delete this contact?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        location.reload();
                    }
                };
                xhr.open("GET", "delete-contact.php?contactId=" + contactId, true);
                xhr.send();
            }
        }

        function searchContacts() {
            var searchInput = document.getElementById('search-input').value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('search-results').innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "search-contacts.php?search=" + encodeURIComponent(searchInput), true);
            xhr.send();
        }
    </script>
</body>
</html>
