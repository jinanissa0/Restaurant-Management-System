<?php include('partials/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-BEm4QOQJxOTYbIM1ZzQ0ri7GBZ5nfZcb+3tBWpFfvD7dUM0tLjPu8FQ2Jbyd2uYNT1XkUSuJ8XLiEGOqZOs5Wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php 
        if(isset($_SESSION['add']))
        {
            echo '<div class="alert alert-success">' . $_SESSION['add'] . '</div>';
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="table">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" class="form-control" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" class="form-control" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" class="form-control" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>
<?php 

if(isset($_POST['submit']))
{
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $con = mysqli_connect('localhost', 'root', '', 'food-order');

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $check_query = "SELECT * FROM tbl_admin WHERE username='$username'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['add'] = "Admin Already exists.Please add a different one";
        header("location:".SITEURL.'admin/add-admin.php');
        exit();
    }

    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

    if ($res == TRUE) {
        $_SESSION['add']="Admin Added Successfully";
        header("location:".SITEURL.'admin/manage-admin.php');
    } else {
        $_SESSION['add']="Failed to add admin";
        header("location:".SITEURL.'admin/add-admin.php');
    }

    mysqli_close($con);
}
?>
  <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .main-content {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
        }

        .main-content h1 {
            color: #333;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        .btn-secondary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
        }

        .success {
            color: #4caf50;
        }

        .error {
            color: #dc3545;
        }
    </style>