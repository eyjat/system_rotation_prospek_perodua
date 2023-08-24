<?php

// ::::::::::TOTAL PROSPECT CALCULATOR - PREVIOUS MONTH::::::::::

$tables = array(
    'myviData', 'bezzaData', 'axiaData', 'aruzData', 'ativaData', 'alzaData'
);

$currentMonth = date("m");
$lastMonth = ($currentMonth - 1) > 0 ? ($currentMonth - 1) : 12;
$totalProspectsLastMonth = 0;

foreach ($tables as $table) {
    $sql = "SELECT COUNT(*) AS total FROM $table WHERE MONTH(curDate) = $lastMonth";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalProspectsLastMonth += $row['total'];
}




// ::::::::::PERCENTAGE CALCULATOR - PREVIOUS MONTH::::::::::

$tables = array(
    'myviData', 'bezzaData', 'axiaData', 'aruzData', 'ativaData', 'alzaData'
);

$lastMonth = date("m", strtotime("-1 month"));
$secondLastMonth = date("m", strtotime("-2 months"));

$data = array();

foreach ($tables as $table) {
    $sqlLastMonth = "SELECT COUNT(*) AS total FROM $table WHERE MONTH(curDate) = $lastMonth";
    $resultLastMonth = $conn->query($sqlLastMonth);
    $rowLastMonth = $resultLastMonth->fetch_assoc();
    $totalLastMonth = $rowLastMonth['total'];

    $sqlSecondLastMonth = "SELECT COUNT(*) AS total FROM $table WHERE MONTH(curDate) = $secondLastMonth";
    $resultSecondLastMonth = $conn->query($sqlSecondLastMonth);
    $rowSecondLastMonth = $resultSecondLastMonth->fetch_assoc();
    $totalSecondLastMonth = $rowSecondLastMonth['total'];

    $data[$table] = array(
        'totalLastMonth' => $totalLastMonth,
        'totalSecondLastMonth' => $totalSecondLastMonth
    );
}

$totalProspectsCombinedLastMonth = 0;
$totalProspectsCombinedSecondLastMonth = 0;

foreach ($data as $tableData) {
    $totalProspectsCombinedLastMonth += $tableData['totalLastMonth'];
    $totalProspectsCombinedSecondLastMonth += $tableData['totalSecondLastMonth'];
}

if ($totalProspectsCombinedSecondLastMonth != 0) {
    $percentageIncreaseCombined = (($totalProspectsCombinedLastMonth - $totalProspectsCombinedSecondLastMonth) / $totalProspectsCombinedSecondLastMonth) * 100;
} else {
    $percentageIncreaseCombined = 0; // Set to 0 to avoid NaN
}


// ::::::::::TOTAL PROSPECT CALCULATOR - THIS MONTH:::::::::::

$tables = array(
    'myviData', 'bezzaData', 'axiaData', 'aruzData', 'ativaData', 'alzaData'
);

$currentMonth = date("m");
$lastMonth = date("m", strtotime("-1 month"));

$data = array();

foreach ($tables as $table) {
    $sqlCurrentMonth = "SELECT COUNT(*) AS total FROM $table WHERE MONTH(curDate) = $currentMonth";
    $resultCurrentMonth = $conn->query($sqlCurrentMonth);
    $rowCurrentMonth = $resultCurrentMonth->fetch_assoc();
    $totalCurrentMonth = $rowCurrentMonth['total'];

    $sqlLastMonth = "SELECT COUNT(*) AS total FROM $table WHERE MONTH(curDate) = $lastMonth";
    $resultLastMonth = $conn->query($sqlLastMonth);
    $rowLastMonth = $resultLastMonth->fetch_assoc();
    $totalLastMonth = $rowLastMonth['total'];

    $data[$table] = array(
        'totalCurrentMonth' => $totalCurrentMonth,
        'totalLastMonth' => $totalLastMonth
    );
}

$totalSalesCombinedCurrentMonth = 0;
$totalSalesCombinedLastMonth = 0;

foreach ($data as $tableData) {
    $totalSalesCombinedCurrentMonth += $tableData['totalCurrentMonth'];
    $totalSalesCombinedLastMonth += $tableData['totalLastMonth'];
}

if ($totalSalesCombinedLastMonth != 0) {
    $percentageIncreaseSalesCombined = (($totalSalesCombinedCurrentMonth - $totalSalesCombinedLastMonth) / $totalSalesCombinedLastMonth) * 100;
} else {
    $percentageIncreaseSalesCombined = 0; // Set to 0 to avoid NaN
}

// ::::::::::TOTAL PROSPECT CALCULATOR - YESTERDAY::::::::::

// Calculate total prospects for yesterday from both myviData and bezzaData tables
$tables = array('myviData', 'bezzaData', 'axiaData', 'aruzData', 'ativaData', 'alzaData');

$yesterday = date("Y-m-d", strtotime("-1 day"));
$dayBeforeYesterday = date("Y-m-d", strtotime("-2 days"));

$dataYesterday = array();
$dataDayBeforeYesterday = array();

foreach ($tables as $table) {
    $sqlYesterday = "SELECT COUNT(*) AS total FROM $table WHERE curDate = '$yesterday'";
    $resultYesterday = $conn->query($sqlYesterday);
    $rowYesterday = $resultYesterday->fetch_assoc();
    $totalYesterday = $rowYesterday['total'];

    $sqlDayBeforeYesterday = "SELECT COUNT(*) AS total FROM $table WHERE curDate = '$dayBeforeYesterday'";
    $resultDayBeforeYesterday = $conn->query($sqlDayBeforeYesterday);
    $rowDayBeforeYesterday = $resultDayBeforeYesterday->fetch_assoc();
    $totalDayBeforeYesterday = $rowDayBeforeYesterday['total'];

    $dataYesterday[$table] = $totalYesterday;
    $dataDayBeforeYesterday[$table] = $totalDayBeforeYesterday;
}

$totalProspectsCombinedYesterday = 0;
$totalProspectsCombinedDayBeforeYesterday = 0;

foreach ($dataYesterday as $totalYesterday) {
    $totalProspectsCombinedYesterday += $totalYesterday;
}

foreach ($dataDayBeforeYesterday as $totalDayBeforeYesterday) {
    $totalProspectsCombinedDayBeforeYesterday += $totalDayBeforeYesterday;
}

$percentageIncreaseYesterday = 0; // Default value

if ($totalProspectsCombinedDayBeforeYesterday != 0) {
    $percentageIncreaseYesterday = (($totalProspectsCombinedYesterday - $totalProspectsCombinedDayBeforeYesterday) / $totalProspectsCombinedDayBeforeYesterday) * 100;
}


// ::::::::::TOTAL SA CALCULATOR - ACTIVE & INACTIVE::::::::::

$tables = array(
    'myviSA', 'bezzaSA', 'axiaSA', 'aruzSA', 'ativaSA', 'alzaSA'
);

$currentDate = date("Y-m-d");

$dataActive = array();
$dataInactive = array();

foreach ($tables as $table) {
    $sqlActive = "SELECT COUNT(*) AS total FROM $table WHERE endDate >= '$currentDate'";
    $resultActive = $conn->query($sqlActive);
    $rowActive = $resultActive->fetch_assoc();
    $totalActive = $rowActive['total'];

    $sqlInactive = "SELECT COUNT(*) AS total FROM $table WHERE endDate < '$currentDate'";
    $resultInactive = $conn->query($sqlInactive);
    $rowInactive = $resultInactive->fetch_assoc();
    $totalInactive = $rowInactive['total'];

    $dataActive[$table] = $totalActive;
    $dataInactive[$table] = $totalInactive;
}

$totalActiveSA = 0;
$totalInactiveSA = 0;

foreach ($dataActive as $totalActive) {
    $totalActiveSA += $totalActive;
}

foreach ($dataInactive as $totalInactive) {
    $totalInactiveSA += $totalInactive;
}


// ::::::::::TOTAL PROSPECT CALCULATOR - LAST WEEK::::::::::

$tables = array(
    'myviData', 'bezzaData', 'axiaData', 'aruzData', 'ativaData', 'alzaData'
);

$lastWeekStartDate = date("Y-m-d", strtotime("-1 week"));
$lastWeekEndDate = date("Y-m-d", strtotime("-1 day")); // Ends yesterday

$weekBeforeLastStartDate = date("Y-m-d", strtotime("-2 weeks"));
$weekBeforeLastEndDate = date("Y-m-d", strtotime("-1 week -1 day"));

$dataLastWeek = array();
$dataWeekBeforeLast = array();

foreach ($tables as $table) {
    $sqlLastWeek = "SELECT COUNT(*) AS total FROM $table WHERE curDate BETWEEN '$lastWeekStartDate' AND '$lastWeekEndDate'";
    $resultLastWeek = $conn->query($sqlLastWeek);
    $rowLastWeek = $resultLastWeek->fetch_assoc();
    $totalLastWeek = $rowLastWeek['total'];

    $sqlWeekBeforeLast = "SELECT COUNT(*) AS total FROM $table WHERE curDate BETWEEN '$weekBeforeLastStartDate' AND '$weekBeforeLastEndDate'";
    $resultWeekBeforeLast = $conn->query($sqlWeekBeforeLast);
    $rowWeekBeforeLast = $resultWeekBeforeLast->fetch_assoc();
    $totalWeekBeforeLast = $rowWeekBeforeLast['total'];

    $dataLastWeek[$table] = $totalLastWeek;
    $dataWeekBeforeLast[$table] = $totalWeekBeforeLast;
}

$totalProspectsCombinedLastWeek = 0;
$totalProspectsCombinedWeekBeforeLast = 0;

foreach ($dataLastWeek as $totalLastWeek) {
    $totalProspectsCombinedLastWeek += $totalLastWeek;
}

foreach ($dataWeekBeforeLast as $totalWeekBeforeLast) {
    $totalProspectsCombinedWeekBeforeLast += $totalWeekBeforeLast;
}

if ($totalProspectsCombinedWeekBeforeLast != 0) {
    $percentageIncreaseLastWeek = (($totalProspectsCombinedLastWeek - $totalProspectsCombinedWeekBeforeLast) / $totalProspectsCombinedWeekBeforeLast) * 100;
} else {
    $percentageIncreaseLastWeek = 0; // Set to 0 to avoid NaN
}


// ::::::::::TOTAL PROSPECT CALCULATOR - LAST WEEK::::::::::

$tables = array(
    'myviData', 'bezzaData', 'axiaData', 'aruzData', 'ativaData', 'alzaData'
);

$totalProspectsAllTimeCombined = 0;
$percentageAllTime = array();
$totalProspectsAllTime = array();

foreach ($tables as $table) {
    $sqlTotalProspects = "SELECT COUNT(*) AS total FROM $table";
    $resultTotalProspects = $conn->query($sqlTotalProspects);
    $rowTotalProspects = $resultTotalProspects->fetch_assoc();
    $totalProspectsAllTime[$table] = $rowTotalProspects['total'];

    $totalProspectsAllTimeCombined += $totalProspectsAllTime[$table];
}

foreach ($tables as $table) {
    $percentageAllTime[$table] = ($totalProspectsAllTime[$table] / $totalProspectsAllTimeCombined) * 100;
}

$percentageMyvi = $percentageAllTime['myviData'];
$percentageBezza = $percentageAllTime['bezzaData'];
$percentageAxia = $percentageAllTime['axiaData'];
$percentageAruz = $percentageAllTime['aruzData'];
$percentageAtiva = $percentageAllTime['ativaData'];
$percentageAlza = $percentageAllTime['alzaData'];

$totalProspectsAllTimeMyvi = $totalProspectsAllTime['myviData'];
$totalProspectsAllTimeBezza = $totalProspectsAllTime['bezzaData'];
$totalProspectsAllTimeAxia = $totalProspectsAllTime['axiaData'];
$totalProspectsAllTimeAruz = $totalProspectsAllTime['aruzData'];
$totalProspectsAllTimeAtiva = $totalProspectsAllTime['ativaData'];
$totalProspectsAllTimeAlza = $totalProspectsAllTime['alzaData'];




$conn->close();

?>