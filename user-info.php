<?php
session_start();
include("db.php");

if (!isset($_SESSION['uname'])) {
    header("Location: login.html");
    exit();
}

$uname = $_SESSION['uname'];
$query = "SELECT * FROM users WHERE uname = '$uname'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $update_query = "UPDATE users SET email = '$email', password = '$password' WHERE uname = '$uname'";
        mysqli_query($conn, $update_query);

        echo "<script>alert('Profile updated successfully!');</script>";
        header("Refresh: 0; URL=user-info.php");
    } elseif (isset($_POST['delete'])) {
        $delete_query = "DELETE FROM users WHERE uname = '$uname'";
        mysqli_query($conn, $delete_query);

        session_destroy();
        echo "<script>alert('Profile deleted successfully!');</script>";
        header("Location: login.html");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">Cyber Help</div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="success-stories.html">Success Stories</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="user-info.php">User Info</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="form-section">
        <h2>Your Profile</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= $user['username']; ?>" readonly>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $user['email']; ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?= $user['password']; ?>" required>

            <button type="submit" name="update">Update Profile</button>
        </form>

        <form method="POST" action="">
            <button type="submit" name="delete" style="background-color: red; color: white;">Delete Profile</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Cyber Help. All rights reserved.</p>
    </footer>
</body>
</html>
