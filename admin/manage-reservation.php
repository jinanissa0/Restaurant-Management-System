<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Reservations</h1>
        <br>
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Reservation Date</th>
                    <th>Name</th>
                    <th>Seats</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM dineIn";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $reservation_date = $row['reservation_date'];
                        $name = $row['Name'];
                        $seats = $row['seats'];
                        $phone = $row['Phone'];
                        $email = $row['Email'];
                        $status = $row['status'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $reservation_date; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $seats; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $email; ?></td>
<td>
                            <?php
                                if($status=="reserved") 
                                {
                                    echo"<label>$status</label>";
                                }
                                
                                elseif($status=="Cancelled")
                                {
                                    echo"<Label style='color:red;'>$status</label>";
                                }
                                elseif($status=="Reserved")
                                {
                                    echo"<Label style='color:green;'>$status</label>";
                                }
                                ?>
                            <td>
                            <a href="<?php echo SITEURL;?>admin/update-reservation.php?id=<?php echo $id; ?>" class="btn-secondary">Update Reservation</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='error'>No reservations found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

