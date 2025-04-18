<?php
$host = "localhost";
$user = "root";
$password = "mysql";
$database = "helpunimasterclass";
$port = 3307;

// Create connection
$conn = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}
?>