<?php
require_once('./DbOperation.php');
$response = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) and isset($_POST['age']) and isset($_POST['height']) and isset($_POST['weight']) and isset($_POST['last_vaccination']) and isset($_POST['last_vaccine']) and isset($_POST['Client_ID'])) {
        $db = new DbOperation();

        // Call the Post_KID method to add the kid to the database
        $result = $db->Post_KID(
            $_POST['name'],
            $_POST['age'],
            $_POST['height'],
            $_POST['weight'],
            $_POST['last_vaccination'],
            $_POST['last_vaccine'],
            $_POST['Client_ID']
        );

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
