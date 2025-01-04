<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br>
        <?Php 
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>       
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.H</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM tbl_order";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $price * $qty;
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>
                        <tr>
                            <td><?php echo $sn++?>. </td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php
                                if($status=="reserved") 
                                {
                                    echo"<label>$status</label>";
                                }
                                elseif($status=="On Delivery")
                                {
                                    echo"<Label style='color:orange;'>$status</label>";
                                }
                                elseif($status=="Delivered")
                                {
                                    echo"<Label style='color:green;'>$status</label>";
                                }
                                elseif($status=="Cancelled")
                                {
                                    echo"<Label style='color:red;'>$status</label>";
                                }
                                ?>
                            </td>
                            <td><?php echo $customer_name;?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                            <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='12' class='error'>Order not available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<style>

.tbl-full {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.tbl-full th, .tbl-full td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.tbl-full th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.tbl-full tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
}

.status.reserved {
    background-color: #ffc107;
    color: #000;
}

.status.on-delivery {
    background-color: #ff9800;
    color: #fff;
}

.status.delivered {
    background-color: #4caf50;
    color: #fff;
}

.status.cancelled {
    background-color: #f44336;
    color: #fff;
}
</style>