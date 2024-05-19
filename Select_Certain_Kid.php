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

// Check if the ID parameter is present
if (isset($_GET['ID'])) {
    // Sanitize and retrieve the ID parameter
    $id = mysqli_real_escape_string($conn, $_GET['ID']);

    // Query to retrieve the specific kid with the provided ID
    $sql = "SELECT * FROM kids WHERE ID = '$id'";

    // Execute the query and store the result in a variable
    $result = mysqli_query($conn, $sql);

    // Check if a single result is found
    if (mysqli_num_rows($result) == 1) {
        // Fetch the row and store the data in an array
        $kid = mysqli_fetch_assoc($result);

        // Encode the array as JSON and output it
        echo json_encode($kid);
    } else {
        // No kid found with the provided ID
        echo "Kid not found.";
    }
} else {
    // ID parameter is missing
    echo "No ID provided.";
}

// Close the connection
mysqli_close($conn);
