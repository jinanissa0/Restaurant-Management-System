<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">

<div class="main-content">
    <div class="container flex justify-center items-center h-screen">
        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <h1 class="text-3xl font-bold mb-8">Update Admin</h1>

        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    header('location: ' . SITEURL . 'admin/manage-admin.php');
                    exit();
                }
            }
        ?>

        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="full_name" class="block text-gray-700 font-semibold mb-2">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo $full_name; ?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-semibold mb-2">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Update Admin</button>
            </form>
        </div>
    </div>
</div>

<?php 
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $sql = "UPDATE tbl_admin SET full_name = '$full_name', username = '$username' WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = "Admin updated successfully";
        header('location: ' . SITEURL . 'admin/manage-admin.php');
        exit();
    } else {
        $_SESSION['update'] = "Failed to update admin";
        header('location: ' . SITEURL . 'admin/manage-admin.php');
        exit();
    }
}
?>


