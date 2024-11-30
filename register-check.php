<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (uname, email, password) VALUES ('$uname', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registration successful!');</script>";
        header("Refresh: 0; URL=login.html");
    } else {
        echo "<script>alert('Error: Could not register.');</script>";
        header("Refresh: 0; URL=register.html");
    }
}
?>
