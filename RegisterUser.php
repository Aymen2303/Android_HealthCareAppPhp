<?php
require_once('./DbOperation.php');
$response = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['user_type'])) {
        ///operate data 

        $db = new DbOperation();

        $resullt = $db->createUser(
            $_POST['username'],
            $_POST['password'],
            $_POST['email'],
            $_POST['user_type']
        );

        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "User registered successfully";
        } else if ($result == 2) {
            $response['error'] = true;
            $response['message'] = "Some error occurred please try again";
        } else if ($result == 0) {
            $response['error'] = true;
            $response['message'] = "Username and email are already in use, Try different ones!";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Required fields are missing!";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}


echo json_encode($response);
