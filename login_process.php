<?php
session_start();

// Check if email and password are provided
if(isset($_POST['email']) && isset($_POST['password'])) {
    // Assign email and password to session variables
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];

    // Redirect to inbox.php
    header('Location: inbox.php');
    exit();
} else {
    // If email and/or password are not provided, redirect back to login page
    header('Location: login.php');
    exit();
}
?>
