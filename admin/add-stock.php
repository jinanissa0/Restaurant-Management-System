<?php include('partials/menu.php'); ?>

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
            <h1 class="card-title">Add To Stock</h1>

            <?php 
            if(isset($_SESSION['add']))
            {
                echo '<div class="alert alert-success">' . $_SESSION['add'] . '</div>';
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo '<div class="alert alert-danger">' . $_SESSION['upload'] . '</div>';
                unset($_SESSION['upload']);
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Select Image:</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="text" name="Quantity" id="quantity" class="form-control" placeholder="Quantity" required>
                </div>

                <div class="mb-3">
                    <label for="expiryDate" class="form-label">Expiry Date:</label>
                    <input type="text" name="ExpiryDate" id="expiryDate" class="form-control" placeholder="Expiry Date" required>
                </div>

                <div class="mb-3">
                    <input type="submit" name="submit" value="Add To Stock" class="btn btn-primary">
                </div>
                </form>
        <?php 
        //check if submit is clicked
        if(isset($_POST['submit']))
        {
            $title = $_POST['title'];
            $Quantity = $_POST['Quantity'];
            $ExpiryDate = $_POST['ExpiryDate'];
            if(isset($_FILES['image']['name']));
            $image_name=$_FILES['image']['name'];
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/stock/".$image_name;
            $upload=move_uploaded_file($source_path,$destination_path);
            if($upload==false)
            {
                $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                header('location:'.SITEURL.'admin/add-stock.php');
            }
        

            $sql = "INSERT INTO tbl_stock SET
                title='$title',
                image_name='$image_name',
                Quantity='$Quantity',  -- Add a comma here
                ExpiryDate='$ExpiryDate'
            ";
            
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                $_SESSION['add'] = "<div class='success'> Added successfully</div>";

                header('location:'.SITEURL.'admin/manage-stock.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add</div>";
                header('location:'.SITEURL.'admin/add-stock.php');
            }
        }
        ?>
    </div>
</div>
</html>
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
            border-radius: 8px;
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