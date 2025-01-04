<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete Food</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>