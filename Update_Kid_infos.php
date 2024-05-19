<?php

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

// Retrieve the kid ID from the GET parameter
$kidId = isset($_GET['ID']) ? $_GET['ID'] : null;
$age = isset($_GET['age']) ? $_GET['age'] : null;
$height = isset($_GET['height']) ? $_GET['height'] : null;
$weight = isset($_GET['weight']) ? $_GET['weight'] : null;
$date = isset($_GET['lastVaccination']) ? $_GET['lastVaccination'] : null;
$vaccine = isset($_GET['lastVaccine']) ? $_GET['lastVaccine'] : null;

// Check if all required parameters are set
if ($kidId && $age && $height && $weight && $date && $vaccine) {
    // Update the kid's information in the database
    $query = "UPDATE kids SET age = '$age', height = '$height', weight = '$weight', last_vaccination = '$date', last_vaccine = '$vaccine' WHERE ID = '$kidId'";
    $result = mysqli_query($conn, $query);

    // Check if the update was successful
    if ($result) {
        echo "Kid's information updated successfully.";
    } else {
        echo "Error updating kid's information: " . mysqli_error($conn);
    }
} else {
    echo "Missing required parameters.";
}

// Close the database connection
mysqli_close($conn);
