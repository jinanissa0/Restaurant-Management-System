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
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Add Food</h1>
                <?php
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title of the food" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Description of the food" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category" required>
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Categories Found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label d-block">Featured
                            <input type="radio" class="form-check-input" name="featured" value="Yes">
                        </label>
                        <label class="form-check-label d-block">Not Featured
                            <input type="radio" class="form-check-input" name="featured" value="No" checked>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label d-block">Active
                            <input type="radio" class="form-check-input" name="active" value="Yes" checked>
                        </label>
                        <label class="form-check-label d-block">Not Active
                            <input type="radio" class="form-check-input" name="active" value="No">
                        </label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-primary">Add Food</button>
                    </div>
                </form>
  <?php
                if (isset($_POST['submit'])) {
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                    $active = isset($_POST['active']) ? $_POST['active'] : "No";

                    $image_name = "";
                    if (isset($_FILES['image']['name'])) {
                        $image_name = $_FILES['image']['name'];

                        if ($image_name != "") {
                            $extArray = explode('.', $image_name);
                            $ext = end($extArray);
                            $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;

                            $src = $_FILES['image']['tmp_name'];
                            $dst = "../images/food/" . $image_name;

                            $upload = move_uploaded_file($src, $dst);

                            if ($upload == false) {
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                header('location: ' . SITEURL . 'admin/add-food.php');
                                die();
                            }
                        }
                    }

                    $sql2 = "INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'";

                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2 == true) {
                        $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                        header('location: ' . SITEURL . 'admin/manage-food.php');
                    } else {
                        $_SESSION['add'] = "<div class='error'>Failed to add Food.</div>";
                        header('location: ' . SITEURL . 'admin/add-food.php');
                    }
                }
                ?>
            </div>
        </div>
    </div>
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
</style>