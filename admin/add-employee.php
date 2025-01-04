<?php include('partials/menu.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add To Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">

    <h1>Add Employee</h1>
    <br>
    <?php
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
     ?>
    

    <form action="" method="POST">

    <table class="tbl-30">
        <tr>
            <td>Full Name:</td>
            <td>
                <div class="mb-3">
                    <input type="text" name="Name" class="form-control" placeholder=" Name" required>
                </div>
            </td>
        </tr>
        <tr>
            <td>Role:</td>
            <td>
                <div class="mb-3">
                    <input type="text" name="Role" class="form-control" placeholder=" Role" required>
                </div>
            </td>
        </tr>
        <tr>
        <td>Salary:</td>
            <td>
                <div class="mb-3">
                    <input type="text" name="Salary" class="form-control" placeholder="Salary" required>
                </div>
            </td>
        </tr>
        <tr>
        <td>Schedule:</td>
            <td>
                <div class="mb-3">
                    <input type="text" name="schedule" class="form-control" placeholder=" Schedule" required>
                </div>
            </td>
        </tr>
        <tr>
            
            <td >
                <div class="mb-3">
                    <input type="submit" name="submit" value="Add Employee" class="btn-secondary">
                </div>
            </td>
        </tr>
    </table>
</form>

</div>


</div>
<?php 
if(isset($_POST['submit']))
{
    $Name = $_POST['Name'];
    $Role = $_POST['Role'];
    $Salary = $_POST['Salary'];
    $schedule = $_POST['schedule'];
  

    $con = mysqli_connect('localhost', 'root', '', 'food-order');

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $check_query = "SELECT * FROM tbl_employees WHERE Name ='$Name'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['add'] = "Employee Already exists.Please add a different one";
        header("location:".SITEURL.'admin/add-employee.php');
        exit(); 
    }


    $sql = "INSERT INTO tbl_employees (Name, Role, Salary,schedule) VALUES ('$Name', '$Role', '$Salary','$schedule')";

    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

    if ($res == TRUE) {
        $_SESSION['add']="Employee Added Successfully";
        header("location:".SITEURL.'admin/manage-Employees.php');
    } else {
        $_SESSION['add']="Failed to add employee";
        header("location:".SITEURL.'admin/add-employee.php');
    }

    mysqli_close($con);
}
?>
<style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 24px;
            color: #343a40;
        }

        .form-label {
            color: #495057;
        }

        .form-control {
            border-radius: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            border-radius: 8px;
        }
    </style>