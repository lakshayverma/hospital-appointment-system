<?php

require_once('../includes/initialize.php');
give_access(TRUE, TRUE);
if (isset($session->user_id)) {
    $user = $session->get_user_object();
    $appointment = Appointment::find_by_id($_POST['appointment_id']);

    if (!isset($_POST['use_requested']) && !empty($_POST['time_at']) && !empty($_POST['date_at'])) {
        $time_at = $_POST['time_at'];
        $date_at = $_POST['date_at'];

        $appointment->at = $date_at . " " . $time_at;
    }
    switch ($_POST['submit']) {
        case 'Schedule':
            $task = 'Scheduled';
            break;
        case 'Complete':
            $task = 'Completed';
            break;
        default :
            $task = 'Updated';
            break;
    }
    $appointment->remarks = $_POST['remarks'];

    if ($appointment->save()) {
        $session->message("Appointment has been {$task}");
    } else {
        $session->message("Appointment Error");
    }
} else {
    $session->message('System error, Login and try again later.');
    redirect_to("login.php");
}
redirect_to("appointment_details.php?id={$appointment->id}");
?>