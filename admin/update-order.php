<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">

<div class="main-content">
    <div class="container">
        <h1 class="text-3xl font-bold mb-8">Update Order</h1>
        <?php 
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
            } else {
                header('location: ' . SITEURL . 'admin/manage-order.php');
                exit();
            }
        } else {
            header('location: ' . SITEURL . 'admin/manage-order.php');
            exit();
        }
        if(isset($_POST['submit'])) {
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $total = $price * $qty;
        
            $sql_update = "UPDATE tbl_order SET qty=$qty, total=$total, status='$status' WHERE id=$id";
            $res_update = mysqli_query($conn, $sql_update);
            
            if($res_update) {
                $_SESSION['update'] = "<div class='alert alert-success'>Order updated successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-order.php');
            } else {
                $_SESSION['update'] = "<div class='alert alert-danger'>Failed to update order.</div>";
                header('location: ' . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>

        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="food" class="block text-gray-700 font-semibold mb-2">Food Name:</label>
                    <input type="text" id="food" name="food" value="<?php echo $food;?>" readonly class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
                    <input type="text" id="price" name="price" value="$<?php echo $price ?>" readonly class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="qty" class="block text-gray-700 font-semibold mb-2">Quantity:</label>
                    <input type="number" id="qty" name="qty" value="<?php echo $qty ?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Status:</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border rounded-md">
                        <option value="Ordered" <?php if($status=="Ordered") echo "selected"; ?>>Ordered</option>
                        <option value="On Delivery" <?php if($status=="On Delivery") echo "selected"; ?>>On Delivery</option>
                        <option value="Delivered" <?php if($status=="Delivered") echo "selected"; ?>>Delivered</option>
                        <option value="Cancelled" <?php if($status=="Cancelled") echo "selected"; ?>>Cancelled</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Update Order</button>
            </form>
        </div>
    </div>
</div>


