<?php require_once('../includes/initialize.php'); ?>
<?php

$doctor = $_POST['doctor'];
$patient = $_POST['patient'];
$description = $_POST['description'];
$time_at = $_POST['time_at'];
$date_at = $_POST['date_at'];

$at = $date_at . " " . $time_at;

$about = $_POST['about'];

$appointment = Appointment::make($doctor, $patient, $at, $about, $description);

if ($appointment->valid()) {
    $message = ($appointment->save()) ? 'Appointment Scheduled' : 'Need to reschedule the Appointment';
} else {
    $message = "The doctor you chose can not be consulted for the problem you chose.";
}
$session->message($message);
redirect_to("index.php");
?>