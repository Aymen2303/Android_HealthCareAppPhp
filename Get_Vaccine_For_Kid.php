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

// Get the kid ID from the GET parameters
$kidId = $_GET['ID'];

// Fetch the age of the kid from the kids table
$kidQuery = "SELECT age FROM kids WHERE id = $kidId";
$kidResult = mysqli_query($conn, $kidQuery);
$kidRow = mysqli_fetch_assoc($kidResult);
$kidAge = $kidRow['age'];

// Prepare the SQL query to fetch the vaccines based on the age of the kid
$query = "SELECT * FROM vaccine WHERE Age >= $kidAge";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Create an empty array to store the vaccine data
    $vaccines = array();

    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Add the row data to the vaccines array
        $vaccines[] = $row;
    }

    // Convert the vaccines array to JSON format
    $response = json_encode($vaccines);

    // Send the JSON response back to the client
    echo $response;
} else {
    // If the query failed, return an error message
    echo "Failed to fetch vaccines.";
}

// Close the database connection
mysqli_close($conn);
