<?php
session_start();
include 'db-connect.php';

if (!isset($_SESSION['uname'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['uname'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET email = ?, password = ? WHERE uname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $hashedPassword, $username);
} else {
    $sql = "UPDATE users SET email = ? WHERE uname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $username);
}

if ($stmt->execute()) {
    $_SESSION['success'] = "Profile updated successfully.";
    header("Location: user-info.html");
} else {
    $_SESSION['error'] = "Error updating profile. Please try again.";
    header("Location: user-info.html");
}
?>
