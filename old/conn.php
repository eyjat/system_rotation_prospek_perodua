<?php
$host = "localhost";
$username = "pemajudi_prospekperodua";
$password = "prospekperodua1234*";
$dbname = "pemajudi_prospekperodua";

// Membuat connection
$conn = new mysqli($host, $username, $password, $dbname);

// jika connection error
if ($conn->connect_error) {
    die("connection tidak berjaya : " . $conn->connect_error);
}

//jika connection berjaya
echo "connection berjaya";

$conn->close();
?>