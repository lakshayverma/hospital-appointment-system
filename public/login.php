<?php
require_once("../includes/initialize.php");

if ($session->is_logged_in()) {
    $session->message($message);
    redirect_to("index.php");
}

// Remember to always give form's submit tag a name="submit" attribute!
if (isset($_POST['submit']) && $_POST['submit'] == 'Login') { // Form was submitted.
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $found_user = User::authenticate($username, $password);
    if ($found_user) {
        $session->login($found_user);
        log_action("Login: " . $username, "logged in.");
        redirect_to("index.php");
    } else {
        // username/password combo was not found in the database.
        $message = "Username/Password combination incorrect.";
        log_action("Login:" . $username, $message);
    }
} else { // Form has not been submitted.
    $username = "";
    $password = "";
}
?>
<?php include_layout_template('header.php'); ?>
<div class="row">

    <div class="h4 text-warning">
        <?php echo output_message($message); ?>
    </div>

    <form method="post" action="create_account.php" class="col-md-5 col-md-offset-1 panel panel-primary">
        <h3 class="panel-heading">
            <span class="glyphicon glyphicon-user"></span>
            Create New Account
        </h3>
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
                <input required type="tel" name="mobile" value="" placeholder="0123456789" class="form-control">
            </label>
        </div>
        
        <input type="hidden" name="type" value="Patient">
        <input type="hidden" name="specializations[]" value="">

        <div class="row">
            <label class="col-md-6"><input type="submit" name="submit" value="Create Account" class="btn btn-block btn-success"></label>
            <label class="col-md-6"><input type="reset" class="btn btn-block btn-danger"></label>
        </div>
    </form>

    <form method="post" action="login.php" class="col-md-5 col-md-offset-1 panel panel-success">
        <h2 class="panel-heading">Login to website</h2>
        <div class="panel-body">
            <div class="row">
                <label class="col-md-12">
                    User Name: <input type="text" name="username" maxlength="30" value="<?php htmlentities($username); ?>" class="form-control" />
                </label>
            </div>
            <div class="row">
                <label class="col-md-12">
                    Password: <input type="password" name="password" maxlength="30" value="<?php htmlentities($password); ?>" class="form-control">
                </label>
            </div>
            <div class="row">
                <label class="col-md-12"><input type="submit" name="submit" value="Login" class="btn btn-block btn-success"></label>
            </div>
        </div>
    </form>
</div>
<?php include_layout_template('footer.php'); ?>