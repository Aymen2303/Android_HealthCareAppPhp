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
$sql = " SELECT * FROM `user` WHERE user_type = 'Client'; ";

// Execute the query and store the result in a variable
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result and store the data in an array
    $users = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    // Encode the array as JSON and output it
    echo json_encode($users);
} else {
    // No results found
    echo "No users found.";
}

// Close the connection
mysqli_close($conn);

?>



