<?php
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

// Database connection
// Establish your database connection here
$host = "localhost";
$username = "pemajudi_prospekperodua";
$password = "prospekperodua1234*";
$dbname = "pemajudi_prospekperodua";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

$queryDate = "SELECT * FROM myviData WHERE curDate BETWEEN '$startDate' AND '$endDate'";
$resultDate = mysqli_query($conn, $queryDate);

/*$query = "SELECT * FROM myviData WHERE curDate BETWEEN '$startDate' AND '$endDate'";
error_log($query); // Check the error log for the generated query

if (!$resultDate) {
    error_log('Query error: ' . mysqli_error($conn));
}*/

ob_start();
while ($row = mysqli_fetch_assoc($resultDate)) {
    // Generate table rows as in your original code
    echo "<tr class='hover:bg-gray-200'>";
    echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosName"] . "</td>";
    echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosNum"] . "</td>";
    echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosLocation"] . "</td>";
    echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["saName"] . "</td>";
    echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["curDate"] . "</td>";
    echo "</tr>";
}
$response = ob_get_clean();

echo $response;
?>