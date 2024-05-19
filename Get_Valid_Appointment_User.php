<?php

// Define your database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the Client_ID parameter is set
if (isset($_GET['Client_ID'])) {

    $clientID = mysqli_real_escape_string($conn, $_GET['Client_ID']);

    // Query to retrieve appointment information for the specified Client_ID
    $sql = "SELECT appointments.*, kids.name AS kid_name, user.username AS nurse_name
            FROM appointments
            INNER JOIN kids ON appointments.Kids_ID = kids.ID
            INNER JOIN user ON appointments.Nurse_ID = user.ID
            WHERE appointments.Client_ID = '$clientID' AND appointments.Approved = 1";

    // Execute the query and store the result in a variable
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Create an array to store the appointment information
            $appointments = array();

            // Loop through each row in the result and store the data in the array
            while ($row = mysqli_fetch_assoc($result)) {
                $appointments[] = $row;
            }

            // Encode the array as JSON
            $jsonArray = json_encode($appointments);

            // Output the JSON array
            echo $jsonArray;
        } else {
            // No results found for the specified Client_ID
            echo json_encode(array('message' => 'No appointments found for the specified Client ID.'));
        }
    } else {
        // Query execution failed
        echo json_encode(array('message' => 'Error: ' . mysqli_error($conn)));
    }
} else {
    // Client_ID parameter not provided
    echo json_encode(array('message' => 'Client ID parameter not provided.'));
}

// Close the connection
mysqli_close($conn);
