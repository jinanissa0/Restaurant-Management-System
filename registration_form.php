<!DOCTYPE html>
<html lang="en">
    <style>.user-actions {
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
}</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Create an Account</h2>
        <form method="post" action="register.php" class="form">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register" class="btn">
            </div>
            <div class="user-actions">
            <a href="foods.php">Go Back</a>
           
        </div>
        </form>
    </div>
</body>
</html>
