<?php


// Required functions
function __autoload($class_name) {
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}

function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

// HTML Functions
function include_layout_template($template = "") {
    include(SITE_ROOT . DS . 'public' . DS . 'layouts' . DS . $template);
}

function output_message($message = "", $class = "") {
    if (!empty($message)) {
        return "<p class=\"alert alert-warning {$class}\">{$message}</p>";
    } else {
        return "";
    }
}

function strip_zeros_from_date($marked_string = "") {
    // remove marked zeros
    $no_zeros = str_replace("*0", "", $marked_string);

    // remove remaining marks
    $cleaned_string = str_replace("*", "", $no_zeros);
    return $cleaned_string;
}

// LOG functions
function log_action($action, $message = "") {
    $file = SITE_ROOT . DS . 'logs' . DS . 'site_logs.txt';
    if ($handle = fopen($file, 'a')) {
        $log = "";
        $log .= strftime("%Y-%m-%d %H:%M:%S", time()) . " | ";
        $log .= $action . " " . $message . "\r\n";
        fwrite($handle, $log);
        fclose($handle);
    }
}

function get_all_logs() {
    $file = SITE_ROOT . DS . 'logs' . DS . 'site_logs.txt';
    $log = "";
    if ($handle = fopen($file, 'r')) {
        $log = fread($handle, filesize($file));
        fclose($handle);
    }
    if (empty(trim($log))) {
        $log = "No log information available yet.";
    }
    return $log;
}

function wipe_all_logs($user_id) {
    $file = SITE_ROOT . DS . 'logs' . DS . 'site_logs.txt';

    $username = User::find_by_id($user_id)->username;
    if ($handle = fopen($file, 'w')) {
        $log = "user: {$username} with id: " . $user_id . " cleared all previous logs on ";
        $log .= strftime("%Y-%m-%d %H:%M:%S", time());
        $log .= "\r\n";
        fwrite($handle, $log);
        fclose($handle);
    }
}

function give_access($onlyAdmin = true, $onlyUsers = false) {
    global $session;
    if($onlyUsers){
        if(isset($session->user_id) && $user = $session->get_user_object()){
            if($onlyAdmin && !$user->is_admin()){
                $session->message("Login again as Only Admins can view the page");
                redirect_to("login.php");
            }
        }  else {
            $session->message("You need to login first.");
            redirect_to("login.php");
        }
    }
    return TRUE;
}
?>