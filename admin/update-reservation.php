<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">

<div class="main-content">
      <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-8">Update Reservation</h1>
        <?php 
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM dineIn WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $name = $row['Name'];
                $seats = $row['seats'];
                $phone = $row['Phone'];
                $email = $row['Email'];
                $reservation_date = $row['reservation_date'];
                $status = $row['status'];
            } else {
                header('location: ' . SITEURL . 'admin/manage-reservation.php');
                exit();
            }
        } else {
            header('location: ' . SITEURL . 'admin/manage-reservation.php');
            exit();
        }
        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $seats = $_POST['seats'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $reservation_date = $_POST['reservation_date'];
            $status = $_POST['status'];
        
            $sql_update = "UPDATE dineIn SET Name='$name', seats='$seats', Phone='$phone', Email='$email', reservation_date='$reservation_date', status='$status' WHERE id=$id";
            $res_update = mysqli_query($conn, $sql_update);
            
            if($res_update) {
                if ($status == "Reserved") {
                    $to = $email;
                    $subject = "Reservation Confirmation";
                    $message = "Dear $name,\n\nYour reservation for $seats seats on $reservation_date has been confirmed.\n\nThank you for choosing our restaurant.\n\nBest regards,\nRestaurant Name";
                    $headers = "From: no-reply@restaurant.com";

                    mail($to, $subject, $message, $headers);
                }
                
                $_SESSION['update'] = "<div class='alert alert-success'>Reservation updated successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-reservation.php');
            } else {
                $_SESSION['update'] = "<div class='alert alert-danger'>Failed to update reservation.</div>";
                header('location: ' . SITEURL . 'admin/manage-reservation.php');
            }
        }
        ?>

        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Full Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $name;?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="seats" class="block text-gray-700 font-semibold mb-2">Seats:</label>
                    <input type="text" id="seats" name="seats" value="<?php echo $seats;?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $phone;?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email;?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="reservation_date" class="block text-gray-700 font-semibold mb-2">Reservation Date:</label>
                    <input type="text" id="reservation_date" name="reservation_date" value="<?php echo $reservation_date;?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Status:</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border rounded-md">
                        <option value="Reserved" <?php if($status=="Reserved") echo "selected"; ?>>Reserved</option>
                        <option value="Cancelled" <?php if($status=="Cancelled") echo "selected"; ?>>Cancelled</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Update Reservation</button>
            </form>
        </div>
    </div>
</div>
