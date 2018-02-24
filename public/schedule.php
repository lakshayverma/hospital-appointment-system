<?php
require_once('../includes/initialize.php');
give_access(TRUE, TRUE);
if (isset($session->user_id)) {
    $user = $session->get_user_object();
}
?>
<?php include_layout_template('header.php'); ?>
<?php
echo output_message($session->message());
?>

<article class="col-md-12 panel panel-primary">
    <h3 class="panel-heading">
        <span class="glyphicon glyphicon-calendar"></span>
        Your Schedule
    </h3>
    <?php if ($appointments = Appointment::get_for_doctor($user->id)): ?>
        <?php foreach ($appointments as $appointment): ?>
            <section class="panel <?php echo ($appointment->remarks) ? "panel-success" : "panel-warning"; ?>">
                <h3 class="panel-heading">
                    <a class="btn btn-warning" title="Edit Details" href="appointment_details.php?id=<?php echo $appointment->id; ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                        <span><?php echo $appointment->about; ?></span>
                    </a>

                    <cite class="panel-title">
                        <?php echo $appointment->description; ?>
                    </cite>

                </h3>
                <div class="panel-body">
                    <strong>
                        <span class="glyphicon glyphicon-blackboard"></span>
                        Remarks
                    </strong>
                    <blockquote class="col-md-12">
                        <?php
                        if (!empty($appointment->remarks)) {
                            echo $appointment->remarks;
                        }
                        ?>
                    </blockquote>
                </div>

                <div class="panel-footer">
                    <em>
                        <span class="glyphicon glyphicon-calendar"></span>
                        <?php echo "at " . $appointment->at . " with " . User::find_by_id($appointment->patient)->introduce(); ?>
                    </em>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else: ?>
        <section class="panel-body">
            <blockquote>
                No one has requested an appointment with you.
            </blockquote>
        </section>
    <?php endif; ?>
</article>


<?php include_layout_template('footer.php'); ?>