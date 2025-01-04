<?php include('partials-front/menu.php'); ?>

<?php 
if(isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);
    
    if($res) {
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    } else {
        header('location:'.SITEURL);
        exit();
    }
} else {
    header('location:'.SITEURL);
    exit();
}
?>
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id AND active = 'Yes'";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2) {
            $count = mysqli_num_rows($res2);
            
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id=$row['id'];
                    $food_title = $row['title'];
                    $food_price = $row['price'];
                    $food_description = $row['description'];
                    $food_image = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $food_image; ?>" alt="<?php echo $food_title; ?>" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $food_title; ?></h4>
                            <p class="food-price">$<?php echo $food_price; ?></p>
                            <p class="food-detail"><?php echo $food_description; ?></p>
                            <br>
                            <a href="order.php?food_id=<?php echo $row['id']; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "<div class='error'>No food items found for this category.</div>";
            }
        } else {
            echo "<div class='error'>Error fetching food items.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
