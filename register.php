<?php
session_start();
include 'config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $telephone = $_POST['telephone'];
    $role = $_POST['role'];

    // Validate form data (You can add more validation as needed)
    if ($password != $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into database
    $sql = "INSERT INTO users (username, email, password, telephone, status) VALUES ('$username', '$email', '$hashed_password', '$telephone', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
