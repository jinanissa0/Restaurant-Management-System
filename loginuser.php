<?php include('config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Food Order System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: url(https://img.freepik.com/premium-photo/illustration-coffee-shop-interior-with-tables-chairs-ai-generated_843560-184.jpg?w=740);
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    .login-container {
        background-color: #fff;
        max-width: 400px;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .login-header {
        background-color:rgb(255, 119, 0);
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    .login-header h2 {
        margin: 0;
        font-weight: 400;
    }

    .login-form {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-color:rgb(255, 119, 0);
    }

    .btn-primary {
        background-color:rgb(255, 119, 0);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
        display: block;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color:rgb(0, 204, 255);
    }

    .created-by {
        text-align: center;
        margin-top: 20px;
        color: #777;
    }

    .login-footer {
        background-color: #f4f4f4;
        padding: 10px 20px;
        text-align: center;
        font-size: 14px;
    }

    .login-footer a {
        color: #007bff;
        text-decoration: none;
    }
</style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Login</h2>
        </div>
        <form action="" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" name="submit" class="btn-primary">Login</button>
        </form>
        <div class="login-footer">
            <p class="created-by">Restaurant System </p>
        </div>
    </div>
</body>
</html>


<?php
if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $sql = "SELECT * FROM tbl_users WHERE username='$username'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            if (password_verify($password, $row['password'])) {
                $_SESSION['loginuser'] = "<div class='success'>Login Successful.</div>";
                $_SESSION['userlogin'] = $username;
                $_SESSION['user_id'] = $row['id'];
                header("Location: user_account.php");
                exit();
            } else {
                $_SESSION['loginuser'] = "<div class='error text-center'>Username or password did not match</div>";
                header('Location: loginuser.php');
                exit();
            }
        } else {
            $_SESSION['loginuser'] = "<div class='error text-center'>Username or password did not match</div>";
            header('Location: loginuser.php');
            exit();
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }
}
?>