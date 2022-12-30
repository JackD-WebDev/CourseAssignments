<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/27/22

// Check if the form has been submitted:
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // For processing the login:
    require('includes/login_functions.php');
    // Need the database connection:
    require('../../../my_sqli_connect.php');
    // Check the login:
    /** @noinspection PhpUndefinedVariableInspection */
    list($check, $data) = check_login($dbc, $_POST['email'],  $_POST['pass']);
    if($check) {
        // Set the session data:
        session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);
        redirect_user('loggedin.php');
    } else {
        $errors = $data;
    }
    mysqli_close($dbc);
}
include('includes/login_page.php');
?>