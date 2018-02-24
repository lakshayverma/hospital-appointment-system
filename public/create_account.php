<?php

require_once("../includes/initialize.php");
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['mail'];
    $type = $_POST['type'];
    $specializations = NULL;
    if (isset($_POST['specializations']) && $type != 'Patient') {
        $specializations = $_POST['specializations'];
        $new_specialization = trim($_POST['new_specialization']);
        if(!empty($new_specialization)){
            $specializations[] = $new_specialization;
        }
    }

    $client = User::make($first_name, $last_name, $username, $password, $dob, $address, $mobile, $email, $type, $specializations);
    if ($client->validate_data()) {
        $message = ($client->save()) ? "Created account for {$client->full_name()} under the name {$client->username}" : "Could not process the request.";
        $session->login($client);
        print_r($client);
    } else {
        $message = "Could not process invalid/empty data";
    }
    $session->message($message);
    redirect_to('login.php');
}
?>