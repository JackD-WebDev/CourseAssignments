<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 6/04/22

$pageTitle = 'Register';
include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('mysqli_oop_connect.php');
    $errors = [];

    // Check for a first name:
    if(empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $fn = $mysqli->real_escape_string(trim($_POST['first_name']));
    }
    // Check for a last name:
    if(empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $ln = $mysqli->real_escape_string(trim($_POST['last_name']));
    }
    // Check for an email address:
    if(empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $e = $mysqli->real_escape_string(trim($_POST['email']));
    }
    // Check for a password and match against the confirmed password:
    if(!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            /** @noinspection PhpUndefinedVariableInspection */
            $p = password_hash(trim($_POST['pass1']), PASSWORD_DEFAULT);
        }
    } else {
        $errors[] = 'You forgot to enter your password.';
    }

    if(empty($errors)) {

        // Register the user in the database...
        /** @noinspection PhpUndefinedVariableInspection */
        /** @noinspection SqlInsertValues */
        $q = "INSERT INTO `users` (first_name, last_name, email, pass, registration_date)
            VALUES ('$fn', '$ln', '$e', '$p', NOW())";
        /** @noinspection PhpUndefinedVariableInspection */
        $r = $mysqli->query($q);

        if ($mysqli->affected_rows == 1) {
            // Print a message:
            echo '<h1>Thank you!</h1>   
            <p>You are now registered. In Chapter 12 you will actually be able to log in! </p><p><br></p>';
        } else {
            // Public message:
            echo '<h1>System Error</h1> 
            <p class="error">You could not be registered due to a system error. We apologize for  any inconvenience.</p>';
            // Debugging message:
            echo '<p>' . $mysqli->error . '<br><br>Query: ' . $q . '</p>';
            }
            $mysqli->close();
            unset($mysqli);

            // Include the footer and quit the script:
            include('includes/footer.php');
            exit();
        } else {
            echo '<h1>Error!</h1>
                <p class="error">The following error(s) occurred:<br>';
            foreach($errors as $msg) {
                echo " - $msg<br>\n";
        }
        echo '</p><p>Please try again.</p><p><br></p>';
    }
    /** @noinspection PhpUndefinedVariableInspection */
    $mysqli->close();
    unset($mysqli);
}
?>

<!-- Registration Form -->
<h1>Register</h1>
<form action="register.php" method="post">
    <p><label>First Name: <input
        type="text"
        name="first_name"
        size="15"
        maxlength="20"
        value="<?php
            if (isset($_POST['first_name'])) echo $_POST['first_name'];
        ?>">
    </label></p>
    <p><label>Last Name: <input
        type="text"
        name="last_name"
        size="15"
        maxlength="40"
        value="<?php
            if  (isset($_POST['last_name'])) echo $_POST['last_name'];
        ?>">
    </label></p>
    <p><label>Email Address: <input
        type="email"
        name="email"
        size="20"
        maxlength="60"
        value="<?php
            if  (isset($_POST['email'])) echo $_POST['email'];
        ?>">
    </label></p>
    <p><label>Password: <input
        type="password"
        name="pass1"
        size="10"
        maxlength="20"
        value="<?php
            if  (isset($_POST['pass1'])) echo $_POST['pass1'];
        ?>">
    </label></p>
    <p><label>Confirm Password: <input
        type="password"
        name="pass2"
        size="10"
        maxlength="20"
        value="<?php
            if (isset($_POST['pass2'])) echo $_POST['pass2'];
        ?>">
    </p>
    <p><input
        type="submit"
        name="submit"
        value="Register">
    </label></p>
</form>

<?php include('includes/footer.php'); ?>