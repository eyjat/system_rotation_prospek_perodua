<?php
    include 'layout/header.php';
?>

        <!-- Content -->
        <div class="flex-1 p-8 sm:ml-64 mt-10">
            <!-- Add Sa Page -->
            <section id="add-sa" class="flex items-center justify-center mt-20">
                
                <!-- Add SA Button (Top Right) -->
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <?php
include 'controller/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $name = $_POST['nameSA'];
    $phone = $_POST['phoneNum'];
    $location = $_POST['locationSA'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $carModel = $_POST['carModel'];

    // Determine which table to insert data based on the selected car model
    if ($carModel == "Myvi") {
        $sqlInsert = "INSERT INTO myviSA (nameSA, phoneNum, locationSA, startDate, endDate)
                      VALUES ('$name', '$phone', '$location', '$startDate', '$endDate')";
    } elseif ($carModel == "Bezza") {
        $sqlInsert = "INSERT INTO bezzaSA (nameSA, phoneNum, locationSA, startDate, endDate)
                      VALUES ('$name', '$phone', '$location', '$startDate', '$endDate')";
    } elseif ($carModel == "Aruz") {
        $sqlInsert = "INSERT INTO aruzSA (nameSA, phoneNum, locationSA, startDate, endDate)
                      VALUES ('$name', '$phone', '$location', '$startDate', '$endDate')";
    } elseif ($carModel == "Axia") {
        $sqlInsert = "INSERT INTO axiaSA (nameSA, phoneNum, locationSA, startDate, endDate)
                      VALUES ('$name', '$phone', '$location', '$startDate', '$endDate')";
    } elseif ($carModel == "Ativa") {
        $sqlInsert = "INSERT INTO ativaSA (nameSA, phoneNum, locationSA, startDate, endDate)
                      VALUES ('$name', '$phone', '$location', '$startDate', '$endDate')";
    } elseif ($carModel == "Alza") {
        $sqlInsert = "INSERT INTO alzaSA (nameSA, phoneNum, locationSA, startDate, endDate)
                      VALUES ('$name', '$phone', '$location', '$startDate', '$endDate')";
    }

    if ($conn->query($sqlInsert) === true) {
        // Insertion successful
        echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-8 rounded relative" role="alert">';
        echo '<p class="font-bold">Success!</p>';
        echo '<p>Your data has been successfully added.</p>';
        echo '</div>';

         // Redirect to referring URL after a short delay (e.g., 3 seconds)
         echo '<script>
         setTimeout(function(){
             window.history.go(-2);
         }, 2000);
     </script>';

    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
}
?>
        <h3 class="text-xl font-semibold mb-4">Add SA Details</h3>
        <form method="POST">
            <!-- SA Name -->
            <div class="mb-4">
                <label for="nameSA" class="block text-sm font-medium text-gray-700">SA Name</label>
                <input type="text" id="nameSA" name="nameSA"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
            </div>
            <!-- Whatsapp Link -->
            <div class="mb-4">
                <label for="phoneNum" class="block text-sm font-medium text-gray-700">Whatsapp Number</label>
                <input type="text" id="phoneNum" name="phoneNum"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
            </div>
            <!-- Car Model Dropdown -->
            <div class="mb-4">
                    <label for="carModel" class="block text-sm font-medium text-gray-700">Car Model</label>
                    <select name="carModel" class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
                    <option value="Axia" <?php if ($_GET['car'] == 'axia') echo 'selected'; ?>>Axia</option>
                        <option value="Aruz" <?php if ($_GET['car'] == 'aruz') echo 'selected'; ?>>Aruz</option>
                        <option value="Ativa" <?php if ($_GET['car'] == 'ativa') echo 'selected'; ?>>Ativa</option>
                        <option value="Alza" <?php if ($_GET['car'] == 'alza') echo 'selected'; ?>>Alza</option>
                        <option value="Bezza" <?php if ($_GET['car'] == 'bezza') echo 'selected'; ?>>Bezza</option>
                        <option value="Myvi" <?php if ($_GET['car'] == 'myvi') echo 'selected'; ?>>Myvi</option>
</select>
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
                    <option value="Pulau Pinang">Pulau Pinang</option>
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
            </section>
            <!-- Other car model sections here -->
        </div>
    </div>
    <script>
    // Get the start date input element
    const startDateInput = document.getElementById("startDate");
    // Get the end date input element
    const endDateInput = document.getElementById("endDate");

    // Add event listener to update the end date
    startDateInput.addEventListener("change", function () {
        // Get the selected start date
        const startDate = new Date(startDateInput.value);
        
        // Calculate 2 months ahead
        const endDate = new Date(startDate);
        endDate.setMonth(startDate.getMonth() + 2);
        
        // Calculate the last day of the month
        const lastDayOfMonth = new Date(endDate.getFullYear(), endDate.getMonth() + 1, 0);
        
        // Format the end date to yyyy-mm-dd
        const formattedEndDate = lastDayOfMonth.toISOString().slice(0, 10);

        // Set the value of the end date input
        endDateInput.value = formattedEndDate;
    });
</script>

    <?php
    include 'layout/footer.php';
?>
</body>

</html>
