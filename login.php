<?php
session_start();
include_once("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link ke Bootstrap untuk styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa; /* Soft blue background */
            font-family: 'Comic Sans MS', cursive, sans-serif; /* Fun and playful font */
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #ffffff; /* White background for the form */
            border-radius: 20px; /* Rounded corners for the form */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #7cd2e5; /* Light Soft Blue color for heading */
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
            color: #7cd2e5; /* Soft blue color for labels */
        }

        .form-control {
            border-radius: 15px; /* Rounded corners for input fields */
            padding: 12px;
            border: 1px solid #b3e0e6; /* Light blue border for inputs */
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #6ec5e9; /* Light blue on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-custom {
            background-color: #7cd2e5; /* Soft blue button */
            color: white;
            border-radius: 25px; /* Rounded corners for button */
            padding: 12px 20px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #56b1c9; /* Slightly darker blue on hover */
        }

        .error-message {
            color: #f06292; /* Soft pink for error messages */
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #7cd2e5; /* Soft blue for registration link */
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php
    if (isset($error)) {
        echo "<div class='error-message'>$error</div>";
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" class="btn btn-custom">Login</button>
    </form>

    <div class="register-link">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</div>

<!-- Link ke Bootstrap JS dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
....