<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/27/22

session_start();
if(!isset($_SESSION['user_id'])) {
    // Need the function:
    require('includes/login_functions.php');
    redirect_user();
} else {
    $_SESSION = [];
    session_destroy();
    setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0);
}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include('includes/header.php');
// Print a customized message:
echo "<h1>Logged Out!</h1>
    <p>You are now logged out!</p>";
include('includes/footer.php');
?>