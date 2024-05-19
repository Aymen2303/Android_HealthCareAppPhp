<?php

require_once('DbConnect.php');

class DbOperation
{
    private $con;

    function __construct()
    {
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    public function createUser($username, $pass, $email, $usertype)
    {
        if ($this->isUserExist($username, $email)) {
            return 0;
        } else {
            $password = md5($pass);

            $stm = $this->con->prepare("INSERT INTO `user` (`username`, `password`, `email`, `user_type`)
                                    VALUES (?, ?, ?, ?)");
            $stm->bind_param("ssss", $username, $password, $email, $usertype);

            if ($stm->execute()) {
                return 1;
            } else {
                return 2;
            }
        }
    }

    public function userLogin($username, $password)
    {
        $hashed_password = md5($password);
        $stmt = $this->con->prepare("SELECT id, user_type FROM user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows() > 0;
    }

    public function getUserByUsername($username)
    {
        $stm = $this->con->prepare("SELECT * FROM user WHERE username=? ");
        $stm->bind_param("s", $username);
        $stm->execute();
        $result = $stm->get_result();
        $user = $result->fetch_assoc();
        $stm->close();
        return $user;
    }


    private function isUserExist($username, $email)
    {
        $stm = $this->con->prepare("SELECT id FROM user WHERE username=? OR email=?");
        $stm->bind_param("ss", $username, $email);
        $stm->execute();
        $stm->store_result();

        return $stm->num_rows > 0;
    }

    public function createAppointment($clientID, $nurseID, $appointmentDate, $kidsID)
    {
        $stmt = $this->con->prepare("INSERT INTO appointments (Client_ID, Nurse_ID, App_Date, Kids_ID) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $clientID, $nurseID, $appointmentDate, $kidsID);

        if ($stmt->execute()) {
            // Appointment created successfully
            return true;
        } else {
            // Failed to create appointment
            return false;
        }
    }


    public function Post_KID($name, $age, $height, $weight, $last_date, $last_vacc, $client_ID)
    {
        $stmt = $this->con->prepare(" INSERT INTO kids (name, age, height, weight, last_vaccination, last_vaccine, Client_ID) VALUES (?,?,?,?,?,?,?) ");
        $stmt->bind_param("sssssss", $name, $age, $height, $weight, $last_date, $last_vacc, $client_ID);
        if ($stmt->execute()) {
            return 1;
            return true;
        } else {
            return 2;
            return false;
        }
    }
}
