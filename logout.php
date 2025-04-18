<?php
session_start(); // Start the session
session_destroy(); // Destroy the session to clear all data
header("Location: login.php"); // Redirect to the login page
exit();
?>