<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   
    $sql = "DELETE FROM tbl_employees WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Employee Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-Employees.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete Employee</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-Employees.php');
}
?>
