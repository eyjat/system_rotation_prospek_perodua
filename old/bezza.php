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

//insert data into database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['saName'];
    $phone = $_POST['phoneNum'];
    $location = $_POST['locationSA'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sqlInsert = "INSERT INTO bezzaSA (nameSA, phoneNum, locationSA, startDate, endDate)
                  VALUES ('$name', '$phone', '$location', '$startDate', '$endDate')";

    if ($conn->query($sqlInsert) === true) {
        // Insertion successful
        header("Location: " . $_SERVER["PHP_SELF"]); // Redirect to the same page
        exit();
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
}

//retrieve data from table myviSA
$sqlSaList = "SELECT * FROM bezzaSA";
$resultSaList = $conn->query($sqlSaList);

//retrieve data from table myviData
$sqlLead = "SELECT * FROM bezzaData";
$resultLead = $conn->query($sqlLead);

//delete data from table

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex">
        <!-- Top Bar -->
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="https://#" class="flex ml-2 md:mr-24">
                    <img src="https://logonoid.com/images/perodua-logo.png" class="h-8 mr-3" alt="Logo" />
                </a>
                </div>
                
            </div>
            </div>
        </nav>
        <!-- End Top Bar -->
        <!-- Side Bar -->
        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                <li>
                    <a href="dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="myvi.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Myvi</span>
                    </a>
                </li>
                <li>
                    <a href="bezza.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Bezza</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Axia</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Alza</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Ativa</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Aruz</span>
                    </a>
                </li>
                </ul>
            </div>
        </aside>
        <!-- End Side Bar -->



        <!-- Content -->
        <div class="flex-1 p-8 sm:ml-64 mt-10">
            <!-- Myvi Page -->
            <section id="myvi" class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Myvi</h2>
                <!-- Add SA Button (Top Right) -->
                <div class="flex items-center space-x-4 float-right">
                             <!-- Search Field -->
        <div>
            <input type="text" class="px-3 py-2 border border-gray-300 rounded-md" placeholder="Search...">
        </div>
         <!-- Dropdown Filter -->
        <div class="relative">
            <select class="px-3 py-2.5 border border-gray-300 rounded-md pr-8">
                <option value="all">All</option>
                <option value="active">Active</option>
                <option value="expired">Expired</option>
            </select>
            
        </div>
        <button class="add-sa-button bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded float-right focus:outline-none focus:ring focus:ring-blue-300">
            <svg class="w-5 h-5 inline-block mr-2 align-middle mt-0.5" fill="currentColor" viewBox="0 0 28 28"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z"
                clip-rule="evenodd"></path>
        </svg>
                    Add SA
                </button>
        <button
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-300"
            onclick="deleteSelected()">
            <svg class="w-5 h-5 inline-block mr-2 align-middle mt-0.5" fill="currentColor" viewBox="0 0 28 28"
                xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
</svg>
            Delete
        </button>
    </div>
                <!-- First Table (SA List) -->
                <div class="mb-6 mt-10">
                    <h3 class="text-lg font-semibold mb-2">SA List</h3>
                    <div class="bg-white p-6 shadow-md rounded-xl">
                        <table class="table-fixed w-full">
                            <thead class="text-gray-800 bg-gray-100">
                                <tr>
                                    <th class="px-3 py-4 w-6 text-left rounded-tl-lg rounded-bl-lg"><input type="checkbox" class="form-checkbox"></th>
                                    <th class="px-4 py-4 text-left">SA Name</th>
                                    <th class="px-4 py-4 text-left">WhatsApp Link</th>
                                    <th class="px-4 py-4 text-left">Location</th>
                                    <th class="px-4 py-4 text-left">Start Date</th>
                                    <th class="px-4 py-4 text-left">Expired Date</th>
                                    <th class="px-2 py-4 w-50px text-center">Status</th>
                                    <th class="px-2 py-4 w-10 text-center rounded-tr-lg rounded-br-lg"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hover:bg-gray-200">
                                    <!--<td class="py-4 px-3 w-6 align-middle">
                                        <input type="checkbox" class="form-checkbox">
                                    </td>-->
                                    <?php
                                        if ( $resultSaList->num_rows > 0 ){
                                        while ($row = $resultSaList->fetch_assoc()) {

                                            echo "<tr class='hover:bg-gray-200'>";

                                            echo "<td class='py-4 px-3 w-6 align-middle'>";
                                            echo "<input type='checkbox' class='form-checkbox'>";
                                            echo "</td>";
                                            
                                            echo "<td class='bpy-4 px-4 border-b border-gray-100'>" . $row["nameSA"] . "</td>";
                                            echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["phoneNum"] . "</td>";
                                            echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["locationSA"] . "</td>";
                                            echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["startDate"] . "</td>";
                                            echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["endDate"] . "</td>";
                                            
                                            echo '<td class="py-4 px-2 text-center border-b border-gray-100">';
                                            echo '<span class="inline-block px-2 py-1 text-sm font-semibold leading-none bg-green-500 text-white rounded">Active</span>';
                                            echo '</td>';

                                            echo '<td class="py-4 px-2 text-center border-b border-gray-100">';
                                            echo '<div class="flex items-center justify-center space-x-2">';
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-600 hover:text-blue-500 cursor-pointer">';
                                            echo '<path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />';
                                            echo '<path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />';
                                            echo '</svg>';
                                            echo '</div>';
                                            echo '</td>';

                                            echo "</tr>";
                                         }
                                         }else{
                                            echo "<tr><td colspan='7' class='py-4 px-2 text-center border-b border-gray-100'>No users found.</td></tr>";
                                            }   
                                        ?>
                                </tr>
                            </tbody>
                        </table>

                        <!--pagination first table-->
                        <nav class="flex justify-end mt-4">
                            <ul class="flex items-center">
                                <li class="mr-2">
                                    <a href="#" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">Previous</a>
                                </li>
                                <li class="mr-2">
                                    <a href="#" class="block border border-blue-500 bg-blue-500 text-white rounded-md px-3 py-1 text-sm">1</a>
                                </li>
                                <li class="mr-2">
                                    <a href="#" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">2</a>
                                </li>
                                <!-- Add more pagination items as needed -->
                                <li class="mr-2">
                                    <a href="#" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">Next</a>
                                </li>
                            </ul>
                        </nav>  
                    </div>
                </div>

                
                <!-- Second Table (Lead) -->
                <div class="mb-8 mt-20">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Lead</h3>
                        <div class="flex space-x-4">
                            <div class="flex space-x-2">
                                <label for="fromDate" class="text-gray-600">From:</label>
                                <input type="date" id="fromDate" class="border rounded-md py-1 px-2 focus:ring focus:ring-blue-300">
                            </div>
                            <div class="flex space-x-2">
                                <label for="toDate" class="text-gray-600">To:</label>
                                <input type="date" id="toDate" class="border rounded-md py-1 px-2 focus:ring focus:ring-blue-300">
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-300">
                                Apply
                            </button>
                        </div>
                    </div>
                    <div class="bg-white p-6 shadow-md rounded-2xl overflow-hidden">
                        <table class="table-fixed w-full">
                            <thead class="text-gray-800 bg-gray-100">
                                <tr>
                                    <th class="px-3 py-4 text-left rounded-tl-xl rounded-bl-xl">Name</th>
                                    <th class="px-4 py-3 text-left">Phone No.</th>
                                    <th class="px-4 py-3 text-left">Location</th>
                                    <th class="px-4 py-3 text-left">SA Name</th>
                                    <th class="px-2 py-4 text-left rounded-tr-xl rounded-br-xl">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ( $resultLead->num_rows > 0 ){
                                    while ($row = $resultLead->fetch_assoc()) {
                                        echo "<tr class='hover:bg-gray-200'>";
                                        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosName"] . "</td>";
                                        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosNum"] . "</td>";
                                        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosLocation"] . "</td>";
                                        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["saName"] . "</td>";
                                        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["curDate"] . "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='7' class='px-4 py-4 border-b border-gray-100'>No users found.</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <nav class="flex justify-end mt-4">
                            <ul class="flex items-center">
                                <li class="mr-2">
                                    <a href="#" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">Previous</a>
                                </li>
                                <li class="mr-2">
                                    <a href="#" class="block border border-blue-500 bg-blue-500 text-white rounded-md px-3 py-1 text-sm">1</a>
                                </li>
                                <li class="mr-2">
                                    <a href="#" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">2</a>
                                </li>
                                <!-- Add more pagination items as needed -->
                                <li class="mr-2">
                                    <a href="#" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">Next</a>
                                </li>
                            </ul>
                        </nav>  
                    </div>  
                </div>
            </section>
            <!-- Other car model sections here -->
        </div>
    </div>

<!-- Add Popup Form -->
<div id="popupForm"
    class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-70 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <div class="flex justify-end">
            <button class="text-gray-600 hover:text-gray-800 focus:outline-none"
                onclick="closePopupForm()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <h3 class="text-xl font-semibold mb-4">Add SA Details</h3>
        <form method = "POST" >
            <!-- SA Name -->
            <div class="mb-4">
                <label for="saName" class="block text-sm font-medium text-gray-700">SA Name</label>
                <input type="text" id="saName" name="saName"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
            </div>
            <!-- Whatsapp Link -->
            <div class="mb-4">
                <label for="phoneNum" class="block text-sm font-medium text-gray-700">Whatsapp Link</label>
                <input type="text" id="phoneNum" name="phoneNum"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
            </div>
            <!-- Location Dropdown -->
            <div class="mb-4">
                <label for="locationSA" class="block text-sm font-medium text-gray-700">Location</label>
                <select id="locationSA" name="locationSA"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
                    <option value="">Select Location</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Putrajaya">Putrajaya</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                </select>
            </div>
            <!-- Start Date -->
            <div class="mb-4">
                <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" id="startDate" name="startDate"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300"
                    min="2023-01-01">
            </div>
            <!-- Expired Date -->
            <div class="mb-4">
                <label for="endDate" class="block text-sm font-medium text-gray-700">Expired Date</label>
                <input type="date" id="endDate" name="endDate"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300"
                    min="2023-01-01">
            </div>
            <div class="mt-4">
                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 w-full rounded focus:outline-none focus:ring focus:ring-blue-300">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // JavaScript to show/hide the popup form
        const addSAButton = document.querySelector('.add-sa-button');
        const popupForm = document.getElementById('popupForm');
        addSAButton.addEventListener('click', () => {
            popupForm.classList.toggle('hidden');
        });
    });

    function closePopupForm() {
        const popupForm = document.getElementById('popupForm');
        popupForm.classList.add('hidden');
    }
</script>
</body>

</html>

<?php ?>