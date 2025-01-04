<?php include('partials/menu.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-BEm4QOQJxOTYbIM1ZzQ0ri7GBZ5nfZcb+3tBWpFfvD7dUM0tLjPu8FQ2Jbyd2uYNT1XkUSuJ8XLiEGOqZOs5Wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <?php 
        if(isset($_SESSION['add']))
        {
            echo '<div class="success">' . $_SESSION['add'] . '</div>';
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo '<div class="error">' . $_SESSION['upload'] . '</div>';
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No" checked>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No" checked>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
<?php 
        if(isset($_POST['submit']))
        {
            $title = $_POST['title'];
            $featured = $_POST['featured'] ?? 'No';
            $active = $_POST['active'] ?? 'No';
            if(isset($_FILES['image']['name']))
            $image_name=$_FILES['image']['name'];
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;
            $upload=move_uploaded_file($source_path,$destination_path);
            if($upload==false)
            {
                $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                
            }
        

            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";
            
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                $_SESSION['add'] = "<div class='success'>Category Added successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>
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
        input[type="file"]
         {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

  input[type="radio"]
  {
    padding: 8px;
    width: 5%;
    box-sizing: border-box;
    margin: 20px 0;
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


