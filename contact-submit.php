<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact_requests (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Thank you for contacting us. We will get back to you shortly.');</script>";
        header("Refresh: 0; URL=contact.html");
    } else {
        echo "<script>alert('Error: Could not send your message. Please try again.');</script>";
        header("Refresh: 0; URL=contact.html");
    }
}
?>
