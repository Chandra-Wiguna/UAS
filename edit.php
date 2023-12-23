<?php
// include database connection file
include_once("config.php");

// Define default message variables
$successMessage = "";
$errorMessage = "";

// Check if form is submitted for user update
if (isset($_POST['update'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    // update user data
    if ($id !== null) {
        $result = mysqli_query($mysqli, "UPDATE users SET name='$name',email='$email',mobile='$mobile' WHERE id=$id");

        // Check if the update was successful
        if ($result) {
            $successMessage = "Terima kasih, Data Anda Berhasil diperbarui.";
        } else {
            $errorMessage = "Gagal memperbarui data: " . mysqli_error($mysqli);
        }
    } else {
        $errorMessage = "ID tidak valid atau tidak diberikan.";
    }
}

// Display selected user data based on id
// Getting id from url
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    // Fetch user data based on id
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

    // Check if the query was successful
    if ($result) {
        $user_data = mysqli_fetch_array($result);
        if ($user_data) {
            $name = $user_data['name'];
            $email = $user_data['email'];
            $mobile = $user_data['mobile'];
        } else {
            $errorMessage = "ID tidak ditemukan dalam database.";
        }
    } else {
        $errorMessage = "Gagal mendapatkan data pengguna: " . mysqli_error($mysqli);
    }
} else {
    $errorMessage = "ID tidak valid atau tidak diberikan.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-top: 4px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .message-container {
            margin-top: 20px;
        }
        .success-message {
            color: green;
            font-size: 18px;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<!-- ... (kode sebelumnya) ... -->
<body>
    <header>
        <h1>Edit User Data</h1>
    </header>
    <div class="container">
        <a href="index.php">Home</a>
        <br/><br/>
        
        <?php if ($id !== null): ?>
            <?php if (empty($errorMessage)): ?>
                <!-- Tampilkan form hanya jika $id valid -->
                <form name="update_user" method="post" action="edit.php">
                    <table>
                        <tr> 
                            <td>Name</td>
                            <td><input type="text" name="name" value="<?php echo $name;?>" required></td>
                        </tr>
                        <tr> 
                            <td>Email</td>
                            <td><input type="text" name="email" value="<?php echo $email;?>" required></td>
                        </tr>
                        <tr> 
                            <td>Mobile</td>
                            <td><input type="text" name="mobile" value="<?php echo $mobile;?>" required></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
                            <td><input type="submit" name="update" value="Update"></td>
                        </tr>
                    </table>
                </form>
            <?php else: ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p class="error-message">ID tidak valid atau tidak diberikan.</p>
        <?php endif; ?>

        <!-- Display success or error message -->
        <div class="message-container">
            <?php if (!empty($successMessage)): ?>
                <p class="success-message"><?php echo $successMessage; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>