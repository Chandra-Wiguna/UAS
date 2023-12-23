<?php
// Create database connection using config file
include_once("config.php");

// Fetch all users data from the database
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>

<html>
<head>
    <title>User Management System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #555;
            color: #fff;
        }

        a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #555;
        }

        .add-user-link {
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .add-user-link a {
            background-color: #5cb85c;
        }

        .add-user-link a:hover {
            background-color: #4cae4c;
        }

        .go-back-link {
            text-align: center;
            margin-top: 20px;
        }

        .go-back-link a {
            background-color: #337ab7;
        }

        .go-back-link a:hover {
            background-color: #286090;
        }
    </style>

    <script>
        function confirmDelete(userId) {
            var confirmDelete = confirm("Are you sure you want to delete this user?");
            if (confirmDelete) {
                window.location.href = "delete.php?id=" + userId;
            }
        }
    </script>
</head>

<body>
    <header>
        <h1>User Management System</h1>
    </header>

    <table>
        <tr>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $user_data['name'] . "</td>";
            echo "<td>" . $user_data['mobile'] . "</td>";
            echo "<td>" . $user_data['email'] . "</td>";
            echo "<td>
                    <a href='edit.php?id=$user_data[id]'>Edit</a> |
                    <a href='javascript:void(0);' onclick='confirmDelete($user_data[id])'>Delete</a>
                </td></tr>";
        }
        ?>
    </table>

    <div class="add-user-link">
        <a href="add.php">Add New User</a>
    </div>

    <div class="go-back-link">
        <a href="landing_page.php">Go Back</a>
    </div>
</body>
</html>