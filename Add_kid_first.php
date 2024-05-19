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

// Retrieve the data from the Android user
$name = isset($_POST['name']) ? $_POST['name'] : null;
$age = isset($_POST['age']) ? $_POST['age'] : null;
$height = isset($_POST['height']) ? $_POST['height'] : null;
$weight = isset($_POST['weight']) ? $_POST['weight'] : null;
$Client_ID = isset($_POST['clientId']) ? $_POST['clientId'] : null;



// Prepare the SQL statement
$sql = "INSERT INTO kids (name, age, height, weight, Client_ID)
        VALUES ('$name', '$age', '$height', '$weight', '$Client_ID')";

// Execute the SQL statement
if (mysqli_query($conn, $sql)) {
    // Insert successful
    $response = array('status' => 'success', 'message' => 'Kid added successfully', 'data' => array(
        'name' => $name,
        'age' => $age,
        'height' => $height,
        'weight' => $weight,
        'Client_ID' => $Client_ID
    ));
    echo json_encode($response);
} else {
    // Insert failed
    $response = array('status' => 'error', 'message' => 'Failed to add kid');
    echo json_encode($response);
}


// Close the database connection
mysqli_close($conn);
