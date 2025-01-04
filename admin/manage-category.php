<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br/><br/>

        <?php 
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>
        <br><br>
        
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.H</th>
                <th>Title</th>
                <th>Image Name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0) {
                $serial = 1;

                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>
                    <tr>
                        <td><?php echo $serial++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php  if ($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Category Image" width="80px">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image not added.</div>";
                                } ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6"><div class="error">No Category Added.</div></td>
                </tr>
                <?php 
            }
            ?>
        </table>
    </div>
</div>


<style>
    .btn {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: white;
        text-align: center;
        font-size: 16px;
        margin: 4px 2px;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .tbl-full {
        width: 100%;
        border-collapse: collapse;
    }

    .tbl-full th, .tbl-full td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .tbl-full th {
        background-color: #f2f2f2;
    }

    .tbl-full tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>