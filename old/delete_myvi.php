<?php
// Database connection
$host = "localhost";
$username = "pemajudi_prospekperodua";
$password = "prospekperodua1234*";
$dbname = "pemajudi_prospekperodua";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID parameter is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the row from the database
    $sqlDelete = "DELETE FROM myviSA WHERE id = $id";

    if ($conn->query($sqlDelete) === true) {
        // Deletion successful
        header("Location: /myvi.php"); // Redirect to the dashboard after deletion
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>