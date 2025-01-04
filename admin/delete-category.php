<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   

    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $sql1="DELETE FROM tbl_food WHERE id=$id";
    $res1 = mysqli_query($conn, $sql1);
    if ($res == true && $res1==true) {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}

?>
