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

// Retrieve the appointment ID and nurse ID from GET parameters
$appointmentID = isset($_GET['ID']) ? $_GET['ID'] : null;
$nurseID = isset($_GET['Nurse_ID']) ? $_GET['Nurse_ID'] : null;

// Check if the appointment ID and nurse ID are provided
if ($appointmentID && $nurseID) {
    // Query to update the 'Approved' and 'Nurse_ID' columns in the appointments table
    $sql = "UPDATE appointments SET Approved = 1, Nurse_ID = $nurseID WHERE ID = $appointmentID";

    // Execute the update query
    if (mysqli_query($conn, $sql)) {
        // Update successful
        echo "Status and Nurse ID updated successfully.";
    } else {
        // Update failed
        echo "Error updating status and Nurse ID: " . mysqli_error($conn);
    }
} else {
    // Appointment ID or nurse ID not provided
    echo "Invalid appointment ID or nurse ID.";
}

// Close the connection
mysqli_close($conn);
