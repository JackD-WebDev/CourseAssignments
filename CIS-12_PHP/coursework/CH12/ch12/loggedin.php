<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/27/22

session_start();
if(!isset($_SESSION['agent']) OR ($_SESSION['agent'] != sha1($_SERVER['HTTP_USER_AGENT']))) {
    // Need the functions:
    require('includes/login_functions.php');
    redirect_user();
}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include('includes/header.php');
// Print a customized message:
echo "<h1>Logged In!</h1>
    <p>You are now logged in, {$_SESSION['first_name']}!</p>
    <p><a href=\"logout.php\">Logout</a></p>";
include('includes/footer.php');
?>