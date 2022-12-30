<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/27/22

$page_title = 'Login';
include('header.php');

// Print any error messages, if they exist:
if(isset($errors) && !empty($errors)) {
    echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br>';
    foreach($errors as $msg) {
        echo " - $msg<br>\n";
    }
    echo '</p><p>Please try again.</p>';
}
// Display the form:
?><h1>Login</h1>
<form action="login.php" method="post">
    <p><label>Email Address: <input
        type="email"
        name="email"
        size="20"
        maxlength="60"
    ></label></p>
    <p><label>Password: <input
        type="password"
        name="pass"
        size="20"
        maxlength="20"
    ></label></p>
    <p><input type="submit" name="submit" value="Login"></p>
</form>

<?php include('footer.php'); ?>