<?php
// Include database connection file
session_start();
include_once("config.php");

// Check if form submitted, insert form data into users table.
if(isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    
    // Insert user data into table
    $result = mysqli_query($mysqli, "INSERT INTO users(name,email,mobile) VALUES('$name','$email','$mobile')");
    
    // Check if the query was successful
    if ($result) {
        $_SESSION['successMessage'] = "User added successfully.";
    } else {
        $_SESSION['errorMessage'] = "Failed to add user: " . mysqli_error($mysqli);
    }

    // Redirect to result.php
    header("Location: result.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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

        a.go-home {
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            margin-left: 20px;
            color: #fff;
            background-color: #333;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        a.go-home:hover {
            background-color: #555;
            color: #fff;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        td:first-child {
            width: 20%;
        }

        input[type="text"] {
            width: calc(100% - 16px);
            padding: 8px;
            box-sizing: border-box;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #555;
            color: #fff;
        }

        .view-users {
            text-align: right;
            margin-top: 20px;
            margin-right: 20px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
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

    <a href="index.php" class="go-home">Go Back</a>

    <form action="add.php" method="post" name="form1" onsubmit="return validateForm()">
        <table>
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" required onkeydown="handleEnterKey(event)"></td>
            </tr>
            <tr> 
                <td>Email</td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr> 
                <td>Mobile</td>
                <td><input type="text" name="mobile" required></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <div class="result-container">
        <?php if (!empty($successMessage)): ?>
            <p class="success-message">    
            <?php echo $successMessage; ?></p>
            <div class="view-users">
                <a href="index.php">View Users</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>