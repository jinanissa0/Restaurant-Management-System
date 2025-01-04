<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
<div class="main-content">
    <div class="container flex justify-center items-center h-screen">
        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <h1 class="text-3xl font-bold mb-8">Update Employee</h1>

        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_employees WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $Name = $row['Name'];
                    $Role = $row['Role'];
                    $Salary = $row['Salary'];
                } else {
                    header('location: ' . SITEURL . 'admin/manage-Employees.php');
                    exit(); // Add an exit to prevent further execution
                }
            }
        ?>
        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="Name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                    <input type="text" id="Name" name="Name" value="<?php echo $Name; ?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="Role" class="block text-gray-700 font-semibold mb-2">Role:</label>
                    <input type="text" id="Role" name="Role" value="<?php echo $Role; ?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="Salary" class="block text-gray-700 font-semibold mb-2">Salary:</label>
                    <input type="text" id="Salary" name="Salary" value="<?php echo $Salary; ?>" class="w-full px-3 py-2 border rounded-md">
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Update Employee</button>
            </form>
        </div>
    </div>
</div>

<?php 
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $Name = $_POST['Name'];
    $Role = $_POST['Role'];
    $Salary = $_POST['Salary'];
    $sql = "UPDATE tbl_employees SET Name = '$Name', Role = '$Role', Salary ='$Salary' WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = "Employee updated successfully";
        header('location: ' . SITEURL . 'admin/manage-Employees.php');
        exit();
    } else {
        $_SESSION['update'] = "Failed to update Employee";
        header('location: ' . SITEURL . 'admin/manage-Employees.php');
        exit();
    }
}
?>


