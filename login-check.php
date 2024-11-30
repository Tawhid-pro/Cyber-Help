<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE uname = '$uname' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['uname'] = $uname;
        header("Location: user-info.php");
    } else {
        echo "<script>alert('Invalid username or password.');</script>";
        header("Refresh: 0; URL=login.html");
    }
}
?>
