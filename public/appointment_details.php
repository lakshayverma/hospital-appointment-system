<?php
require_once('../includes/initialize.php');
give_access(TRUE, TRUE);
if (isset($session->user_id)) {
    $user = $session->get_user_object();
}

if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $appointment = Appointment::find_by_id($appointment_id);
    $patient = User::find_by_id($appointment->patient);
}
?>
<?php include_layout_template('header.php'); ?>
<?php echo output_message($session->message()); ?>
<form class="panel panel-primary col-md-8 col-md-offset-2" method="post" action="edit_appointment.php">
    <?php if (isset($appointment)):
        ?>
        <h3 class="panel-heading">
            <span class="glyphicon glyphicon-calendar"></span>
            Appointment Details
        </h3>

        <div class="form-group row">
            <label class="col-md-4">
                <span>
                    <span class="glyphicon"></span>
                    Appointment ID
                </span>
                <input class="form-control" type="text" name="appointment_id" value="<?php echo $appointment->id; ?>" readonly>
            </label>
            <label class="col-md-8">
                <span>
                    <a class="btn btn-xs btn-default" href="details.php?id=<?php echo $patient->id; ?>" target="window">
                        <span class="glyphicon glyphicon-user"></span>
                        Patient
                    </a>
                </span>
                <input type="hidden" name="patient_id" value="<?php echo $patient->id; ?>">
                <input class="form-control col-md-9" type="text" value="<?php echo $patient->introduce(); ?>" readonly>
            </label>
            <label class="col-md-12">
                <span>
                    Description
                </span>
                <textarea class="form-control" disabled readonly><?php echo $appointment->description; ?></textarea>
            </label>
        </div>

        <div class="form-group row">
            <label class="col-md-4">
                <span>
                    <span class="glyphicon glyphicon-time"></span>
                    Requested Date Time
                </span>
                <input type="text" class="form-control" value="<?php echo $appointment->at; ?>" readonly>
            </label>
            <div class="col-md-8 row">
                <label class="col-md-6 col-sm-12">
                    <span>
                        <span class="glyphicon glyphicon-calendar"></span>
                        Date
                    </span>
                    <input class="form-control" type="date" name="date_at">
                </label>
                <label class="col-md-6 col-sm-12">
                    <span>
                        <span class="glyphicon glyphicon-time"></span>
                        Time
                    </span>
                    <input class="form-control" type="time" name="time_at">
                </label>
                <label class="col-md-12">
                    <input class="checkbox-inline" type="checkbox" name="use_requested">
                    Use requested Date Time
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12">
                <span>
                    Remarks
                </span>
                <textarea required class="form-control" name="remarks" placeholder="Input your remarks"><?php echo $appointment->remarks; ?></textarea>
            </label>
            <?php if (empty($appointment->remarks)): ?>
                <label class="col-md-4 col-md-offset-2">
                    <input class="btn btn-block btn-default" type="submit" name="submit" value="Schedule">
                </label>
            <?php else: ?>
                <label class="col-md-4 col-md-offset-2">
                    <input class="btn btn-block btn-success" type="submit" name="submit" value="Complete">
                </label>
            <?php endif; ?>
            <label class="col-md-4">
                <input class="btn btn-block btn-danger" type="reset" value="Clear">
            </label>
        </div>
    <?php else:
        ?>
        <h3 class="panel-heading">
            <span class="glyphicon glyphicon-warning-sign"></span>
            No Appointment
        </h3>
    <?php
    endif;
    ?>
</form>
<?php include_layout_template('footer.php'); ?>