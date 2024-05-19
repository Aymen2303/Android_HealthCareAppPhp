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

?>


<?php

//Retrieve the request data from the client-side
$clientID = $_POST['Client_ID'];
$nurseID = $_POST['Nurse_ID'];
$appointmentDate = date('Y-m-d', strtotime($_POST['App_Date']));
$kidsID = $_POST['Kids_ID'];

// Insertion of Data
$sql = "INSERT INTO appointments ( Client_ID, Nurse_ID, App_Date, Kids_ID) VALUES ('$clientID', '$nurseID', '$appointmentDate', '$kidsID')";

// Execute the SQL query
if (mysqli_query($conn, $sql)) {
    // Insertion successful
    $response = array('success' => true, 'message' => 'Request stored successfully');
    echo json_encode($response);
} else {
    // Insertion failed
    $response = array('success' => false, 'message' => 'Failed to store request');
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>