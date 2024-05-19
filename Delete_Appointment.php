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

// Retrieve the appointment ID from a GET parameter
$appointmentID = isset($_GET['ID']) ? $_GET['ID'] : null;

// Delete the appointment from the appointments table based on the appointment ID
$sql = "DELETE FROM appointments WHERE ID = '$appointmentID'";

// Execute the query
if (mysqli_query($conn, $sql)) {
    // Check if any rows were affected (i.e., appointment deleted)
    if (mysqli_affected_rows($conn) > 0) {
        echo "Appointment deleted successfully.";
    } else {
        echo "No appointment found with the given ID.";
    }
} else {
    echo "Error deleting appointment: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
