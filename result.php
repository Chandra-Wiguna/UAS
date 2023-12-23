<?php
session_start();
$successMessage = isset( $_SESSION['successMessage']) ? $_SESSION['successMessage'] : "";
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : "";

// /Clear session messages to avoid displaying them again on page reload
// unset($_SESSION['successMessage']);
// unset($_SESSION['errorMessage']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        .message-container {
            text-align: center;
            margin-top: 20px;
        }

        .message {
            margin-top: 10px;
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }

        .options {
            margin-top: 20px;
            text-align: center;
        }

        .options a {
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 18px;
            transition: background-color 0.3s, color 0.3s;
        }

        .options a.add-another {
            background-color: #007bff;
            color: #fff;
        }

        .options a.go-home {
            background-color: #28a745;
            color: #fff;
        }

        .options a:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>
<script>
function validateForm() {
            var name = document.forms["form1"]["name"].value;
            var email = document.forms["form1"]["email"].value;
            var mobile = document.forms["form1"]["mobile"].value;

            if (name === "" || email === "" || mobile === "") {
                alert("Nama, Email, dan Nomor Telepon wajib diisi.");
                return false;
            }
            return true;
        }

        function handleEnterKey(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.forms["form1"]["email"].focus();
            }
        }
    </script>
</head>

<body>
    <header>
        <h1>Add Users</h1>
    </header>

    <div class="message-container">
        <?php if (!empty($successMessage)): ?>
            <div class="message success-message">
                <?php echo $successMessage; ?>
            </div>
        <?php elseif (!empty($errorMessage)): ?>
            <div class="message error-message">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="options">
        <a href="add.php" class="add-another">Add Another User</a>
        <a href="index.php" class="go-home">Go to Home</a>
    </div>
</body>
</html>