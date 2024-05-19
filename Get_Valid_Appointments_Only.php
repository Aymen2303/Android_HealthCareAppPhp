<?php

// Define your database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the nurse ID from a GET parameter
$nurseID = isset($_GET['Nurse_ID']) ? $_GET['Nurse_ID'] : null;

// Query to retrieve approved appointments with 
//associated user username and kid name for the specified nurse ID
$sql = "SELECT appointments.*, user.username AS Client_Username, kids.name AS Kid_Name
        FROM appointments
        JOIN user ON appointments.Client_ID = user.ID
        JOIN kids ON appointments.Kids_ID = kids.ID
        WHERE appointments.Nurse_ID = '$nurseID' AND appointments.Approved = 1";

// Execute the query and store the result in a variable
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result and store the data in an array
        $appointments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }

        // Encode the array as JSON and output it
        echo json_encode($appointments);
    } else {
        // No results found
        echo "No Approved Appointments found.";
    }
} else {
    // Query execution failed
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
