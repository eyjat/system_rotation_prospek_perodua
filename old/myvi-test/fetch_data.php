<?php
$connection = new mysqli('localhost', 'pemajudi_prospekperodua', 'prospekperodua1234*', 'pemajudi_prospekperodua');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Define variables for pagination
$recordsPerPage = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Query to fetch data with pagination
$query = "SELECT * FROM myviSA LIMIT $offset, $recordsPerPage";
$result = $connection->query($query);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($data);

$connection->close();
?>
