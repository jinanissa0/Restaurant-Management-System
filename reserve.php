<?php include('partials-front/menu.php');
if(!isset($_SESSION['user_id'])){
    header('location:' . SITEURL . 'loginuser.php');
}
$userid=$_SESSION['user_id'];
 ?>

    <section class="food-search" style="background-image: url('images/category/bg.jpg');">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your Reservation.</h2>

            <form action="" method="POST" class="order">
                
                </fieldset>
                
                <fieldset>
                    <legend>Reservation Details</legend>
                    <div class="rserve-label">Full Name</div>
                    <input type="text" name="Name" placeholder="E.g. Jinan Issa" class="input-responsive" required>

                    <div class="reserve-label">Phone Number</div>
                    <input type="tel" name="Phone" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="reserve-label">Email</div>
                    <input type="email" name="Email" placeholder="E.g. JinanIssa@gmail.com" class="input-responsive" required>
                    <div class="reserve-label">Date</div>
                    <input type="text" name="reservation_date" placeholder="E.g. 00/00/2025" class="input-responsive" required>
                    <div class="reserve-label">Seats</div>
                    <textarea name="seats" placeholder="E.g. 2" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Reservation" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            if(isset($_POST['submit']))
            {
                
                $reservation_date = date("Y-m-d H:i:s");
                $status = "Reserved";
                $Name = $_POST['Name'];
                $seats = $_POST['seats'];
                $Phone = $_POST['Phone'];
                $Email = $_POST['Email'];
                $sql = "INSERT INTO dineIn (reservation_date, status, Name, seats, Phone, Email, user_id) 
                        VALUES ('$reservation_date', '$status', '$Name', '$seats', '$Phone', '$Email', '$userid')";
                
                $res = mysqli_query($conn, $sql);
                if($res)
                {
                    $_SESSION['order'] = "<div class='success'>Reservation confirmed successfully</div>";
                    header('location: '.SITEURL);
                }
                else
                {
                    $_SESSION['order'] = "<div class='error'>Failed to confirm reservation</div>";
                    header('location: '.SITEURL);
                }
            }
            ?>


        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>
