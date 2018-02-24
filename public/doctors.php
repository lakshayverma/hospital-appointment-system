<?php
require_once('../includes/initialize.php');
give_access(TRUE);
if (isset($session->user_id)) {
    $user = $session->get_user_object();
}
?>
<?php include_layout_template('header.php'); ?>
<?php
echo output_message($session->message());
?>

<article class="col-md-6 panel panel-default">
    <h3 class="panel-heading">Senior Doctors</h3>
    <?php
    $doctors = User::find_all_of_type('Senior Doctor');
    foreach ($doctors as $doctor):
        ?>
        <p>
            <a href="details.php?id=<?php echo $doctor->id; ?>" target="new">
                <?php echo $doctor->introduce(); ?>
            </a>
        </p>
    <?php endforeach; ?>
</article>
<article class="col-md-6 panel panel-default">
    <h3 class="panel-heading">Doctors</h3>
    <?php
    $doctors = User::find_all_of_type('Doctor');
    foreach ($doctors as $doctor):
        ?>
        <p>
            <a href="details.php?id=<?php echo $doctor->id; ?>" target="new">
                <?php echo $doctor->introduce(); ?>
            </a>
        </p>
    <?php endforeach; ?>
</article>
<?php if (isset($user) && $user->type == 'Senior Doctor'): ?>
    <form method="post" action="create_account.php" class="col-md-8 col-md-offset-2 panel panel-primary">
        <h3 class="panel-heading">
            <span class="glyphicon glyphicon-user"></span>
            Create New Doctor
        </h3>
        <div class="row">
            <label class="col-md-6">
                <span>Doctor Type</span>
                <select required name="type" class="form-control" size="4">
                    <option value="Patient">Patient</option>
                    <option value="Doctor" selected>Doctor</option>
                    <option value="Senior Doctor">Senior Doctor</option>
                </select>
            </label>
            <label class="col-md-6">
                <span>Specialization</span>
                <select name="specializations[]" class="form-control" multiple size="4">
                    <?php
                    if ($specializations = Specialization::find_unique()):
                        foreach ($specializations as $specialization):
                            ?>
                            <option value="<?php echo $specialization->body_part; ?>"><?php echo $specialization->body_part; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
                <input class="form-control"  type="text" name="new_specialization" placeholder="Specialization not in list">
            </label>
        </div>
        <div class="row">
            <label class="col-md-6">
                <span>First  Name</span>
                <input required type="text" name="first_name" value="" placeholder="First Name" class="form-control">
            </label>
            <label class="col-md-6">
                <span>Last Name</span>
                <input required type="text" name="last_name" value="" placeholder="Last Name" class="form-control">
            </label>
        </div>

        <div class="row">
            <label class="col-md-6">
                <span>User Name</span>
                <input required type="text" name="username" value="" placeholder="User Name" class="form-control">
            </label>
            <label class="col-md-6">
                <span>Password</span>
                <input required type="password" name="password" value="" placeholder="Password" class="form-control">
            </label>
        </div>

        <div class="row">
            <label class="col-md-6">
                <span>
                    <span class="glyphicon glyphicon-calendar"></span>
                    Date of Birth
                </span>
                <input required type="date" name="dob" value="" class="form-control">
            </label>
            <label class="col-md-6">
                <span>
                    <span class="glyphicon glyphicon-home"></span>
                    Address
                </span>
                <textarea required name="address" placeholder="Your Home Address" class="form-control"></textarea>
            </label>
        </div>
        <div class="row">
            <label class="col-md-6">
                <span>
                    <span class="glyphicon glyphicon-envelope"></span>
                    Email
                </span>
                <input required type="email" name="mail" value="" placeholder="nomail@example.com" class="form-control">
            </label>
            <label class="col-md-6">
                <span>
                    <span class="glyphicon glyphicon-phone"></span>
                    Contact No
                </span>
                <input required type="tel" name="mobile" value="" placeholder="+xx-xxx-xxx-xxx-x" class="form-control">
            </label>
        </div>

        <div class="row">
            <label class="col-md-6"><input type="submit" name="submit" value="Create Account" class="btn btn-block btn-success"></label>
            <label class="col-md-6"><input type="reset" class="btn btn-block btn-danger"></label>
        </div>
    </form>
<?php endif; ?>
<?php include_layout_template('footer.php'); ?>