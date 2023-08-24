<?php
// Step 1 - Location Selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['location'])) {
  // Store the selected location in a session variable
  session_start();
  $_SESSION['selected_location'] = $_POST['location'];
  header('Location: new_flow2.php'); // Redirect to Step 2
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://www.perodua.com.my/assets/images/favicon.ico" type="image/x-icon" async>
</head>

<body class="bg-gray-100 p-4 md:p-0 flex items-center justify-center h-screen">
    <div class="max-w-sm w-full bg-white rounded-lg shadow-md p-6">
        <img src="https://www.perodua.com.my/assets/images/header_menu/perodua-logo.jpg" alt="Perodua Logo"
            class="w-48 mx-auto mb-4">
        <form method="POST" action="">
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-bold mb-2">Select a state:</label>
                <select id="location" name="location"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    <option value="" disabled selected>Select a state</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
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
            <button type="submit"
                class="block w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Submit</button>
        </form>
    </div>
</body>

</html>
