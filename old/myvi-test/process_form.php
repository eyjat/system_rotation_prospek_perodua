<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection setup
$servername = "localhost";
$username = "pemajudi_prospekperodua";
$password = "prospekperodua1234*";
$dbname = "pemajudi_prospekperodua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$prosName = $_POST["prosName"];
$prosNum = $_POST["prosNum"];
$prosLocation = $_POST["locationSA"];

// Get the current date and time in the desired format
$currentDate = date("Y-m-d");

// Function to rotate sales agents based on location
function rotateSalesAgent($location) {
    global $conn;

    $sql = "SELECT nameSA, phoneNum FROM myviSA WHERE locationSA = '$location'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $agents = array();
        while ($row = $result->fetch_assoc()) {
            $agents[] = $row;
        }

        $filename = "last_used_agent.txt";
        $lastAgentIndex = file_exists($filename) ? intval(file_get_contents($filename)) : 0;
        $nextAgentIndex = ($lastAgentIndex + 1) % count($agents);
        file_put_contents($filename, $nextAgentIndex);

        $assignedAgent = $agents[$nextAgentIndex]['nameSA'];
        $assignedPhone = $agents[$nextAgentIndex]['phoneNum'];

        return array('nameSA' => $assignedAgent, 'phoneNum' => $assignedPhone);
    } else {
        return null;
    }
}

$location = $_POST["locationSA"];
$assignedAgentData = rotateSalesAgent($location);

if ($assignedAgentData) {
    $assignedAgent = $assignedAgentData['nameSA'];
    $assignedPhone = $assignedAgentData['phoneNum'];

    $updateAgentQuery = "UPDATE myviSA SET assignedAgent = '$assignedAgent', assignedPhone = '$assignedPhone' WHERE locationSA = '$location'";
    $conn->query($updateAgentQuery);
} else {
    // Fallback: Send WhatsApp to the provided fallback number
    $assignedAgent = "Fallback Agent";
    $assignedPhone = "01120965467";
}

$sqlInsert = "INSERT INTO myviData (prosName, prosNum, prosLocation, curDate, saName) VALUES ('$prosName', '$prosNum', '$prosLocation', '$currentDate', '$assignedAgent')";
$conn->query($sqlInsert);

// WhatsApp API integration
$whatsappApiUrl = "https://api.whatsapp.com/send?phone=6$assignedPhone&text=Hai%20saya%20$prosName,%20berminat%20nak%20beli%20Myvi.";

// Redirect to WhatsApp API URL
header("Location: $whatsappApiUrl");

$conn->close();
?>
