<?php
include_once "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($mysqli, "DELETE FROM users WHERE id = $id");

    if ($result) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Deletion</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f4f4f4;
                    text-align: center;
                    padding: 50px;
                }

                .success-message {
                    background-color: #4CAF50;
                    color: #fff;
                    padding: 15px;
                    border-radius: 5px;
                    margin-bottom: 20px;
                }

                .redirect-message {
                    color: #333;
                    margin-bottom: 20px;
                }

                .return-home-btn {
                    background-color: #008CBA;
                    color: #fff;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                }
            </style>
        </head>
        <body>
            <div class="success-message">
                User berhasil dihapus.
            </div>
            <div class="redirect-message">
                <a href="index.php" class="return-home-btn" id="returnHomeBtn">Kembali ke Home</a>
            </div>
            <script>
                document.addEventListener('keyup', function (e) {
                    if (e.key === 'Enter') {
                        document.getElementById('returnHomeBtn').click();
                    }
                });
            </script>
        </body>
        </html>
        <?php
        exit; // Stop further execution
    } else {
        echo "Gagal menghapus user: " . mysqli_error($mysqli);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
