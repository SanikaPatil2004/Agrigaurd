<?php
session_start();
include("index.php");

// Handle Registration
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $mobno = $_POST['mobno'];

    // Check if passwords match
    if ($password !== $confirm) {
        echo "<script>window.onload = function() { showPopupMessage('Passwords do not match'); };</script>";
    } else {
        // Check if user already exists
        $checkUser = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkUser);

        if ($result->num_rows > 0) {
            echo "<script>window.onload = function() { showPopupMessage('User already exists'); };</script>";
        } else {
            // Insert user data without hashing the password (INSECURE!)
            $sql = "INSERT INTO users (name, email, mobile, password) VALUES ('$username', '$email', '$mobno', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>window.onload = function() { showPopupMessage('Registration successful! Please login.'); };</script>";
            } else {
                echo "<script>window.onload = function() { showPopupMessage('Error: " . $conn->error . "'); };</script>";
            }
        }
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Directly compare passwords (INSECURE!)
        if ($password === $row['password']) {
            $_SESSION['username'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            echo "<script>window.location.href='scan.php';</script>";
            exit;
        } else {
            echo "<script>window.onload = function() { showPopupMessage('Invalid password'); };</script>";
        }
    } else {
        echo "<script>window.onload = function() { showPopupMessage('Invalid username or password'); };</script>";
    }
}
?>
