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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['editFormId'];
    $name = $_POST['nameSA'];
    $phone = $_POST['phoneNum'];
    $location = $_POST['locationSA'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Perform the SQL update query
    $sqlUpdate = "UPDATE myviSA SET nameSA='$name', phoneNum='$phone', locationSA='$location', startDate='$startDate', endDate='$endDate' WHERE id='$id'";

    if ($conn->query($sqlUpdate) === true) {
        // Update successful
        header("Location: dashboard.php"); // Redirect to your dashboard
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
