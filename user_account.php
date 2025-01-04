<?php
include('config\constants.php');

$conn = new mysqli(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_SESSION['user_id'])) {
    header('location:' . SITEURL . 'loginuser.php');
}
$userid = $_SESSION['user_id'];
$sql = "SELECT username, email, created_at FROM tbl_users WHERE id = $userid";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $created_at = $row['created_at'];
} else {
    echo "User not found.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account - Food Order System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }




        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(227, 145, 74);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .user-account-container {
            background-color: #fff;
            max-width: 600px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-info h2 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .user-info p {
            color: #777;
        }

        .user-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .user-actions a {
            color: #007bff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            border: 1px solid #007bff;
            transition: background-color 0.3s ease;
        }

        .user-actions a:hover {
            background-color: #007bff;
            color: #fff;
        }


        /* Bubble starts */
        .bubble-background { 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        
        .bubble {
            position: absolute;
            bottom: -100px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1rem;
            color:black;
            animation: rise 2s infinite ease-in;
            opacity: 0;
        }

        @keyframes rise {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0;
            }

            10% {
                opacity: 0.4;
            }

            50% {
                opacity: 0.8;
            }

            100% {
                transform: translateY(-120vh) scale(1.5);
                opacity: 0;
            }
        }


        .bubble:nth-child(1) {
            left: 10%;
            animation-duration: 5s;
            animation-delay: 2s;
        }

        .bubble:nth-child(2) {
            left: 20%;
            animation-duration: 4s;
            animation-delay: 3s;
        }

        .bubble:nth-child(3) {
            left: 30%;
            animation-duration: 3s;
            animation-delay: 4s;
        }


        .bubble:nth-child(4) {
            left: 40%;
            animation-duration: 4s;
            animation-delay: 4s;
        }




        .bubble:nth-child(5) {
            right: 40%;
            animation-duration: 4s;
            animation-delay: 3s;
        }


        .bubble:nth-child(6) {
            right: 30%;
            animation-duration: 5s;
            animation-delay: 4s;
        }

        .bubble:nth-child(7) {
            right: 10%;
            animation-duration: 4s;
            animation-delay: 3s;
        }


    

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


    </style>
</head>

<body>
    <div class="user-account-container">
        <div class="user-info">
            <h2>Welcome, <?php echo $username; ?></h2>
            <p>Email: <?php echo $email; ?></p>
            <p>Member Since: <?php echo $created_at; ?></p>
        </div>
        <div class="user-actions">
            <a href="index.php">Back To Home</a>
            <a href="view_orders.php">View Orders</a>
            <a href="logoutuser.php">Logout</a>
        </div>
    </div>


     <div class="bubble-background">

        <div class="bubble">Welcome</div>
        <div class="bubble">Welcome</div>
        <div class="bubble">Welcome</div>
        <div class="bubble">Welcome</div>
        <div class="bubble">Welcome</div>
        <div class="bubble">Welcome</div>
        <div class="bubble">Welcome</div>

    </div> 





</body>

</html>
