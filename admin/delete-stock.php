<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   
    $sql = "DELETE FROM tbl_stock WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'> Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-stock.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete </div>";
        header('location:' . SITEURL . 'admin/manage-stock.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-stock.php');
}
?>