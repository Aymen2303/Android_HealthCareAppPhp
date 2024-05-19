<?php
session_start();
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

// Retrieve client ID from the request parameter

$clientID = isset($_GET['client_id']) ? $_GET['client_id'] : null;



// Retrieve child records for the client
$sql = "SELECT * FROM kids WHERE Client_ID = '$clientID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Child records found for the client
    $kids = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $kids[] = $row;
    }

    // Convert kids array to JSON and return it
    $response = json_encode($kids);
    echo $response;
} else {
    // No child records found for the client
    $response = array('message' => 'No child records found for the client');
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
