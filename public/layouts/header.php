<?php
global $session;
if (isset($session->user_id)) {
    $user = $session->get_user_object();
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SITE_TITLE; ?></title>
        <!--
        <link href="styles/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="styles/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet">
        -->
        <link href="styles/css/lakshay.css" type="text/css" rel="stylesheet">
        <!--<link href="styles/css/theme.min.css" type="text/css" rel="stylesheet">-->
    </head>
    <body class="container">
        <header class="row">
            <nav class="navbar">
                <ul class="nav nav-tabs">
                    <?php if (isset($user)): ?>

                        <li class="navbar-right">
                            <a href="logout.php" title="<?php echo $user->full_name(); ?>">
                                Logout
                                <span class="glyphicon glyphicon-log-out"></span>
                            </a>
                        </li>
                        <li class="navbar-right">
                            <a href="edit_profile.php" title="<?php echo $user->full_name(); ?>">
                                Edit Your Profile
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </li>
                        <?php if ($user->type == 'Patient'):
                            ?>
                            <li>
                                <a href="index.php">
                                    <span class="glyphicon glyphicon-time"></span>
                                    Appointments
                                </a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="schedule.php">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    Your Schedule
                                </a>
                            </li>
                            <li>
                                <a href="index.php">
                                    <span class="glyphicon glyphicon-time"></span>
                                    Make Appointments
                                </a>
                            </li>

                            <?php if ($user->type == 'Senior Doctor'): ?>
                                <li>
                                    <a href="logfile.php">
                                        <span class="glyphicon glyphicon-file"></span>
                                        Site Logs
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php
                        endif;
                        ?>
                    <?php else: ?>
                        <li>
                            <a href="login.php">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Login
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="doctors.php">
                            <span class="glyphicon glyphicon-user"></span>
                            Faculty
                        </a>
                    </li>
                </ul>
            </nav>
            <hgroup class="jumbotron">
                <h1><?php echo SITE_TITLE; ?></h1>
                <h3><?php echo SITE_MOTO; ?></h3>
            </hgroup>
        </header>
        <div id="main" class="row">