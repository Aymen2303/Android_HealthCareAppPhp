<?php

///Database connexion
$host =  "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve all records from the vaccine table
$sql = "SELECT * FROM vaccine";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if any records were found
if (mysqli_num_rows($result) > 0) {
    // Initialize an array to hold the vaccine records
    $vaccines = array();

    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Add the row to the vaccines array
        $vaccines[] = $row;
    }

    // Convert the vaccines array to JSON format
    $json = json_encode($vaccines);

    // Output the JSON response
    header('Content-Type: application/json');
    echo $json;
} else {
    // No records found
    echo "No records found.";
}

// Close the connection
mysqli_close($conn);
