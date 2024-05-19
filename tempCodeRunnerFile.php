<?php
require_once('./DbOperation.php');
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['height']) && isset($_POST['weight']) && isset($_POST['last_vaccination']) && isset($_POST['last_vaccine']) && isset($_POST['Client_ID'])) {
        // Retrieve the data from the POST request
        /*  $name = $_POST['name'];
        $age = $_POST['age'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $last_vaccination = $_POST['last_vaccination'];
        $last_vaccine = $_POST['last_vaccine'];
        $client_id = $_POST['Client_ID'];*/

        $name = 'jamila';
        $age = '16';
        $height = '57.1';
        $weight = '11.2';
        $last_vaccination = '2023-05-29';
        $last_vaccine = 'Influenza (Flu)';
        $client_id = '16';

        // Create an instance of DbOperation class
        $db = new DbOperation();

        // Call the Post_KID method to add the kid to the database
        $result = $db->Post_KID($name, $age, $height, $weight, $last_vaccination, $last_vaccine, $client_id);

        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "Kid added successfully";
        } else if ($result == 2) {
            $response['error'] = true;
            $response['message'] = "Failed to add kid";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Invalid request";
}

echo json_encode($response);
