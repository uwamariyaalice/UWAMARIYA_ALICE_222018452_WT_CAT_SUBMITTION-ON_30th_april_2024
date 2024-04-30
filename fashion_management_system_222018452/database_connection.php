<?php
// Database credentials
$hostname = "localhost";
$username = "alice";
$password = "222018452";
$database = "fashion_management_system";

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>