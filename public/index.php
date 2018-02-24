<?php
require_once('../includes/initialize.php');
give_access(FALSE, TRUE);
if (isset($session->user_id)) {
    $user = $session->get_user_object();
}
?>
<?php include_layout_template('header.php'); ?>
<?php
echo output_message($session->message());
?>

<article class="col-md-7 col-md-push-5 col-sm-12 panel panel-primary">
    <h3 class="panel-heading">
        <span class="glyphicon glyphicon-calendar"></span>
        All your appointments
    </h3>
    <?php if ($appointments = Appointment::get_for_user($user->id)): ?>
        <section class="panel-body">
            <ul class="panel-group">
                <?php foreach ($appointments as $appointment): ?>
                    <li class="list-unstyled panel <?php echo ($appointment->remarks) ? "panel-success" : "panel-warning"; ?>">
                        <h3 class="panel-heading">
                            <span class="glyphicon glyphicon-pushpin"></span>
                            <span><?php echo $appointment->about; ?></span>
                            <cite class="panel-title">
                                <?php echo $appointment->description; ?>
                            </cite>
                        </h3>
                        <div class="panel-body">
                            <strong>
                                <span class="glyphicon glyphicon-edit"></span>
                                Doctor's Remarks
                            </strong>
                            <blockquote>
                                <?php
                                if (empty($appointment->remarks)) {
                                    echo 'The doctor has not said anything yet.';
                                } else {
                                    echo $appointment->remarks;
                                }
                                ?>
                            </blockquote>
                        </div>
                        <div class="panel-footer">
                            <em>
                                <span class="glyphicon glyphicon-calendar"></span>
                                <?php echo "at " . $appointment->at . " with Dr." . User::find_by_id($appointment->doctor)->full_name(); ?>
                            </em>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php else: ?>
        <section class="panel-body">
            <blockquote>
                All the appointments you have will show up here.
            </blockquote>
        </section>
    <?php endif; ?>
</article>
<form class="col-md-5 col-md-pull-7 col-sm-12 panel panel-success" action="make_appointment.php" method="post">
    <h3 class="panel-heading">
        <span class="glyphicon glyphicon-plus"></span>
        Make an Appointment
    </h3>
    <input type="hidden" name="patient" value="<?php echo $user->id; ?>">
    <div class="form-group">
        <label class="col-md-6 col-sm-12">
            <span>
                <span class="glyphicon glyphicon-calendar"></span>
                Date
            </span>
            <input required class="form-control" type="date" name="date_at">
        </label>
        <label class="col-md-6 col-sm-12">
            <span>
                <span class="glyphicon glyphicon-calendar"></span>
                Time
            </span>
            <input required class="form-control" type="time" name="time_at">
        </label>
        <label class="col-md-12">
            <span>
                <span class="glyphicon glyphicon-user"></span>
                Doctor
            </span>
            <select required class="form-control" name="doctor">
                <?php
                $doctors = User::find_all_of_type('Senior Doctor');
                foreach ($doctors as $doctor):
                    ?>
                    <option value="<?php echo $doctor->id ?>"><?php echo $doctor->introduce(); ?></option>
                <?php endforeach; ?>
                <?php
                $doctors = User::find_all_of_type('Doctor');
                foreach ($doctors as $doctor):
                    ?>
                    <option value="<?php echo $doctor->id ?>"><?php echo $doctor->introduce(); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label class="col-md-12">
            <span>
                <span class="glyphicon glyphicon-plus"></span>
                About
            </span>
            <select required class="form-control" name="about">
                <?php
                $problems = Specialization::find_unique();
                foreach ($problems as $problem):
                    ?>
                    <option value="<?php echo $problem->body_part ?>"><?php echo $problem->body_part; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label class="col-md-12">
            <span>
                <span class="glyphicon glyphicon-edit"></span>
                Describe your problem a little
            </span>
            <textarea required class="form-control" name="description"></textarea>
        </label>
        <label class="col-md-12">
            <input class="btn btn-block btn-success" type="submit" value="Make Appointment">
        </label>
    </div>
</form>

<?php include_layout_template('footer.php'); ?>