<?php
// Step 2 - Name Field, Phone Number Field, and Button with Rotating Link
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['phone'])) {
  
  //connection database
  $host = "localhost";
  $username = "pemajudi_prospekperodua";
  $password = "prospekperodua1234*";
  $dbname = "pemajudi_prospekperodua";

  $conn = new mysqli($host, $username, $password, $dbname);
  if ($conn->connect_error) {
     die("connection tidak berjaya: " . $conn->connect_error);
    }
  
  // Get the selected location from the session variable
  session_start();
  $selected_location = $_SESSION['selected_location'];

  // Process the form data and generate the rotated link
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $rotated_link = ''; // Set the initial rotated link value
  
  //code to insert data into database
  $sql = "INSERT INTO bezzaData ( prosName, prosNum, prosLocation, saName ) VALUES ( '$name', '$phone', '$selected_location', '$rotated_links')";
  
  //execute the sql query
  if ( $conn->query($sql)==TRUE){
    //data successfully inserted into database
  }else{
    echo "Error: ". $sql . "<br>" . $conn->error;
  }
  
  //close database connetion
  $conn->close();

  // Define the rotated links for each location
  $links = array(
    
    //rotation link for johor
    'Johor' => array(
      'https://api.whatsapp.com/send?phone=60126636690&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601165521613&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=60108408761&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965546&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965547&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for kedah
    'Kedah' => array(
      'https://api.whatsapp.com/send?phone=6010840873&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for kelantan
    'Kelantan' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for melaka
    'Melaka' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for negeri sembilan
    'Negeri Sembilan' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for pahang
    'Pahang' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for pulau pinang
    'Pulau Pinang' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for perak
    'Perak' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for perlis
    'Perlis' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for sabah
    'Sabah' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for sarawak
    'Sarawak' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for selangor
    'Selangor' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    ),
    
    //rotation link for terengganu
    'Terengganu' => array(
      'https://api.whatsapp.com/send?phone=60108408738&text=Hi,%20Saya%20berminat%20dengan%20Myvi...',
      'https://api.whatsapp.com/send?phone=601120965572&text=Hi,%20Saya%20berminat%20dengan%20Myvi...'
    )
  );
  
  //get the crrent rotation index from the session
  session_start();
  if (!isset($_SESSION['rotation_index'])) {
  // If the rotation index is not set, initialize it to 0
  $_SESSION['rotation_index'] = 0;
  } else {
  // Otherwise, increment the rotation index
  $_SESSION['rotation_index']++;
  }
  
  //calculate the modulo value to loop through the links
  $rotation_count = count($links[$selected_location]);
  $rotation_index = $_SESSION['rotation_index'] % $rotation_count;
  
  // Get the rotated link based on the selected location
  /*if (array_key_exists($selected_location, $links)) {
    $rotated_links = $links[$selected_location];
    $rotated_link = $rotated_links[array_rand($rotated_links)];
  }*/
  if (array_key_exists($selected_location, $links)) {
  $rotated_links = $links[$selected_location];
  $rotated_link = $rotated_links[$rotation_index];
  }

  // Redirect to the rotated link
  header("Location: $rotated_link");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://www.perodua.com.my/assets/images/favicon.ico" type="image/x-icon" async>
</head>

<body class="bg-gray-100 p-4 md:p-0 flex items-center justify-center h-screen">
    <div class="max-w-sm w-full bg-white rounded-lg shadow-md p-6">
        <img src="https://www.perodua.com.my/assets/images/header_menu/perodua-logo.jpg" alt="Perodua Logo"
            class="w-48 mx-auto mb-4">
        <form method = "POST" action = "">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" required
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    placeholder="Enter your name">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-bold mb-2">Phone:</label>
                <input type="tel" id="phone" name="phone" required
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    placeholder="Enter your phone number">
            </div>
            <button type="submit"
                class="block w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Submit</button>
        </form>
    </div>
</body>

</html>
