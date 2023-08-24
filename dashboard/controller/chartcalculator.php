<?php
include 'db.php'; // Include your database connection

// Calculate the start date for the last 7 days
$lastWeekStartDate = date("Y-m-d", strtotime("-1 week"));

// Query to fetch combined data from multiple tables for the last 7 days
$query = "SELECT curDate, SUM(total_count) AS entry_count
          FROM (
            SELECT curDate, COUNT(*) AS total_count FROM myviData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM bezzaData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM axiaData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM aruzData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM ativaData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM alzaData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
          ) AS combined_data
          GROUP BY curDate
          ORDER BY curDate";

$result = $conn->query($query);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'date' => $row['curDate'],
            'entry_count' => $row['entry_count']
        );
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
