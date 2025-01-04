<?php
include('config\constants.php');


$conn = new mysqli(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$created_at = date('Y-m-d H:i:s');

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO tbl_users (username, email, password,created_at) VALUES ('$username', '$email', '$hashed_password','$created_at')";
if ($conn->query($sql) === TRUE) {
    header("Location: loginuser.php");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
