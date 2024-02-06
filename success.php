<!-- success.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .message-container {
            text-align: center;
            padding: 20px;
            border: 2px solid #4CAF50;
            border-radius: 10px;
            background-color: #E9F6E8;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Contact Added Successfully!</h1>
        <p>Press Enter to go to the home page.</p>
    </div>
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                window.location.href = 'Home.php';
            }
        });
    </script>
</body>
</html>
