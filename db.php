<?php
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "cyber_help"; // Your DB name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>