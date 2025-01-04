<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Stock</h1>
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
        

        <a href="<?php echo SITEURL; ?>admin/add-stock.php" class="btn-primary">Add To Stock</a>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Image Name</th>
                <th>Quantity</th>
                <th>ExpiryDate</th>
                
            </tr>

            <?php 
            $sql = "SELECT * FROM tbl_stock";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0) {
                $serial = 1;

                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $Quantity = $row['Quantity'];
                    $ExpiryDate = $row['ExpiryDate'];

                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $title; ?></td>

                      

                        <td>
                            <?php  if ($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/stock/<?php echo $image_name; ?>" alt="stock Image" width="80px">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image not added.</div>";
                                } ?>
                        </td>
                        <td><?php echo $Quantity; ?></td>
                        <td><?php echo $ExpiryDate; ?></td>
                        <td>
                            
                            <a href="<?php echo SITEURL; ?>admin/delete-stock.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6"><div class="error">Not Added.</div></td>
                </tr>
                <?php 
            }
            ?>
        </table>
    </div>
</div>

<style>
.table-container {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.tbl-full {
    width: 100%;
    border-collapse: collapse;
}

.tbl-full th, .tbl-full td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.tbl-full th {
    background-color: #f2f2f2;
}

.tbl-full tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    color: #fff;
}

.btn-primary {
    background-color: #007bff;
}

.btn-danger {
    background-color: #dc3545;
}

.error {
    color: #ff0000;
}
</style>