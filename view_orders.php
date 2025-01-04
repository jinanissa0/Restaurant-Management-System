<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Food Order System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .order-list-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .order-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .order-item p {
            margin: 5px 0;
        }

        .order-item strong {
            font-weight: bold;
        }
        .user-actions a {
            color: #007bff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            border: 1px solid #007bff;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>

<div class="order-list-container">
    <h2>Your Orders</h2>
    <?php
    $userid=$_SESSION['user_id'];
    if ($conn) {
        $sql = "SELECT * FROM tbl_order WHERE user_id=$userid";
        $res = mysqli_query($conn, $sql);
    
        if ($res) {
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<div class='order-item'>";
                    echo "<p><strong>Food:</strong> " . $row['food'] . "</p>";
                    echo "<p><strong>Quantity:</strong> " . $row['qty'] . "</p>";
                    echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
                    echo "<p><strong>Order Date:</strong> " . $row['order_date'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No orders found.</p>";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Database connection error.";
    }
    ?>
    <div class="user-actions">
            <a href="foods.php">Go To Menu</a>
           
        </div>
</div>


</body>
</html>
