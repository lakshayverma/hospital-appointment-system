<?php
require_once('../includes/initialize.php');
give_access(FALSE, TRUE);
if (isset($_GET['id'])) {
    $pat_id = $_GET['id'];
    $user = User::find_by_id($pat_id);
}
?>
<?php include_layout_template('header.php'); ?>
<?php
echo output_message($session->message());
?>
<article method="post" class="col-md-8 col-md-offset-2 panel panel-default">

    <h3 class="panel-heading">Profile Details</h3>
    <section class="row">
        <label class="col-md-6">
            <span>First  Name</span>
            <input readonly type="text" name="first_name" value="<?php echo $user->first_name; ?>" placeholder="First Name" class="form-control">
        </label>
        <label class="col-md-6">
            <span>Last Name</span>
            <input readonly type="text" name="last_name" value="<?php echo $user->last_name; ?>" placeholder="Last Name" class="form-control">
        </label>
    </section>
<?php if ($user->type != 'Patient'):
        ?>
        <section class="panel panel-default">
            <h2 class="panel-heading">
                Specializations
            </h2>
            <ul class="">
                <?php foreach (Specialization::get_for_doctor($user->id) as $specialization): ?>
                <li class="list-group-item-heading">
                        <strong>
                            <?php echo $specialization->body_part . "<br />"; ?>
                        </strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <?php
    endif;
    ?>
    <section class="row">
        <label class="col-md-6">
            <span>
                <span class="glyphicon glyphicon-calendar"></span>
                Date of Birth
            </span>
            <input readonly type="date" name="dob" value="<?php echo $user->dob; ?>" class="form-control">
        </label>
        <label class="col-md-6">
            <span>
                <span class="glyphicon glyphicon-home"></span>
                Address
            </span>
            <textarea readonly name="address" placeholder="Your Home Address" class="form-control"><?php echo $user->address; ?></textarea>
        </label>
    </section>
    <section class="row">
        <label class="col-md-6">
            <span>
                <span class="glyphicon glyphicon-envelope"></span>
                Email
            </span>
            <input readonly type="email" name="email" value="<?php echo $user->email; ?>" placeholder="nomail@example.com" class="form-control">
        </label>
        <label class="col-md-6">
            <span>
                <span class="glyphicon glyphicon-phone"></span>
                Contact No
            </span>
            <input readonly type="tel" name="mobile" value="<?php echo $user->mobile; ?>" placeholder="+xx-xxx-xxx-xxx-x" class="form-control">
        </label>
    </section>
</article>

<?php include_layout_template('footer.php'); ?>