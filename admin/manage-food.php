<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Food</h1>
        <br>

        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>

        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $category_id = $row['category_id'];
                        $sql1 = "SELECT * FROM tbl_category WHERE id= $category_id";
                        $res1 = mysqli_query($conn, $sql1);
                        if($res1){
                            $count = mysqli_num_rows($res1);
                            if($count>0){
                                $row1 = mysqli_fetch_assoc($res1);
                                $category_name=$row1['title'];
                            }
                        }
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php
                                if ($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food Image" width="80px">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image not added.</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $category_name; ?></td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-danger">Delete Food</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9"><div class='error'>No Food Items Found</div></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="9"><div class='error'>Failed to retrieve Food Items</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<style>
.food-image {
    width: 80px;
    border-radius: 5px;
}

.error {
    color: #ff0000;
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