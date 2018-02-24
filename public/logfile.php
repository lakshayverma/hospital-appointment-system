<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
?>

<?php
// Clear all logs.
if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
    wipe_all_logs($session->user_id);
}
?>

<?php include_layout_template('header.php'); ?>
<article class="panel panel-default">

    <h2 class="panel-heading">
        <span class="glyphicon glyphicon-file"></span>
        Site Logs
    </h2>
    <section class="panel-body">
        <?php
        echo nl2br(get_all_logs());
        ?>
    </section>
    <footer class="panel-footer">
        <a href="logfile.php?clear=true" class="btn btn-primary">Clear Logs</a>
    </footer>
</article>

<?php include_layout_template('footer.php'); ?>