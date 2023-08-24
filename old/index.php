<?php
// Step 1 - Location Selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['location'])) {
  // Store the selected location in a session variable
  session_start();
  $_SESSION['selected_location'] = $_POST['location'];
  header('Location: flow2.php'); // Redirect to Step 2
  exit();
}
?>

<!-- Step 1 - Location Selection Form -->
<form method="POST" action="">
  <label for="location">Select Location:</label>
  <select name="location" id="location" required>
    <option value="Johor">Johor</option>
    <option value="Kedah">Kedah</option>
    <option value="Kelantan">Kelantan</option>
    <option value="Melaka">Melaka</option>
    <option value="Negeri Sembilan">Negeri Sembilan</option>
    <option value="Pahang">Pahang</option>
    <option value="Pulau Pinang">Pulau Pinang</option>
    <option value="Perak">Perak</option>
    <option value="Perlis">Perlis</option>
    <option value="Sabah">Sabah</option>
    <option value="Sarawak">Sarawak</option>
    <option value="Selangor">Selangor</option>
    <option value="Terengganu">Terengganu</option>
  </select>
  <button type="submit">Next</button>
</form>
