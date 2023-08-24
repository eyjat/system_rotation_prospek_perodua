<?php
$servername = "localhost";
$username = "usernameDB";
$password = "passDB";
$dbname = "nameDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
