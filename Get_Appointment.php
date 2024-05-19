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

// ... Establish connection to database ...

// Query to retrieve all users from the "user" table
$sql = "SELECT * FROM `appointments` ";

// Execute the query and store the result in a variable
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result and store the data in an array
    $nurses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }

    // Encode the array as JSON and output it
    echo json_encode($appointments);
} else {
    // No results found
    echo "No Appointments found.";
}

// Close the connection
mysqli_close($conn);

?>



