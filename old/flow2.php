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
  $sql = "INSERT INTO myviData ( prosName, prosNum, prosLocation, saName ) VALUES ( '$name', '$phone', '$selected_location', '$rotated_links')";
  
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
      'https://api.whatsapp.com/send?phone=60126636690',
      'https://api.whatsapp.com/send?phone=601165521613'
    ),
    
    //rotation link for kedah
    'Kedah' => array(
      'https://api.whatsapp.com/send?phone=6010840873',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for kelantan
    'Kelantan' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for melaka
    'Melaka' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for negeri sembilan
    'Negeri Sembilan' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for pahang
    'Pahang' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for pulau pinang
    'Pulau Pinang' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for perak
    'Perak' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for perlis
    'Perlis' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for sabah
    'Sabah' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for sarawak
    'Sarawak' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for selangor
    'Selangor' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    ),
    
    //rotation link for terengganu
    'Terengganu' => array(
      'https://api.whatsapp.com/send?phone=60108408738',
      'https://api.whatsapp.com/send?phone=601120965572'
    )
  );
  
  // Get the rotated link based on the selected location
  if (array_key_exists($selected_location, $links)) {
    $rotated_links = $links[$selected_location];
    $rotated_link = $rotated_links[array_rand($rotated_links)];
  }

  // Redirect to the rotated link
  header("Location: $rotated_link");
  exit();
}
?>

<!-- Step 2 - Name Field, Phone Number Field, and Button -->
<form method="POST" action="">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" required>
  
  <label for="phone">Phone Number:</label>
  <input type="text" name="phone" id="phone" required>
  
  <button type="submit">Submit</button>
</form>


