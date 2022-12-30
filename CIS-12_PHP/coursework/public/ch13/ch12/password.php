<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/01/22

$pageTitle = 'Change Your Password';
include('includes/header.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../../../my_sqli_connect.php');
    $errors = [];

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    // Check for the current password:
    if (empty($_POST['pass'])) {
        $errors[] = 'You forgot to enter your current password.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
    }

    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your new password did not match the confirmed password.';
        } else {
            /** @noinspection PhpUndefinedVariableInspection */
            $np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'You forgot to enter your new password.';
    }

    if (empty($errors)) {
        // Check that they've entered the right email address/password combination:
        /** @noinspection PhpUndefinedVariableInspection */
        $q = "SELECT user_id FROM `users` WHERE (email='$e' AND pass=SHA2('$p', 512) )";
        /** @noinspection PhpUndefinedVariableInspection */
        $r = @mysqli_query($dbc, $q);
        $num = @mysqli_num_rows($r);

        if ($num == 1) {
            // Get the user_id:
            $row = mysqli_fetch_array($r, MYSQLI_NUM);
            /** @noinspection PhpUndefinedVariableInspection */
            $q = "UPDATE users SET pass=SHA2('$np', 512) WHERE user_id=$row[0]";
            $r = @mysqli_query($dbc, $q);

            if (mysqli_affected_rows($dbc) == 1) {
                // Print a message.
                echo '<h1>Thank you!</h1>
                    <p>Your password has been updated. In Chapter 12 you will actually be able to log  in!</p><p><br></p>';
            } else {
                // Public message:
                echo '<h1>System Error</h1>
                    <p class="error">Your password could not be changed due to a system error.  We apologize for any inconvenience.</p>';
                // Debugging message:
                echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
            }
            mysqli_close($dbc);

            include('includes/footer.php');
            exit();
        } else {
            echo '<h1>Error!</h1>
                <p class="error">The email address and password do not match those on file.</p>';
        }
    } else {
        echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br>';
        foreach ($errors as $msg) {
                echo " - $msg<br>\n";
        }
        echo '</p><p>Please try again.</p><p><br></p>';
    }
    /** @noinspection PhpUndefinedVariableInspection */
    mysqli_close($dbc);
}
?>

<h1>Change Your Password</h1>
<form action="password.php" method="post">
    <p><label>Email Address: <input
        type="email"
        name="email"
        size="20"
        maxlength="60"
        value="<?php
            if (isset($_POST['email'])) echo $_POST['email'];
        ?>">
        </label></p>
    <p><label>Current Password: <input
        type="password"
        name="pass"
        size="10"
        maxlength="20"
        value="<?php
            if (isset($_POST['pass'])) echo $_POST['pass'];
        ?>">
        </label></p>
    <p><label>New Password: <input
        type="password"
        name="pass1"
        size="10" maxlength="20"
        value="<?php
            if (isset($_POST['pass1'])) echo $_POST['pass1'];
        ?>">
        </label></p>
    <p><label>Confirm New Password: <input
        type="password"
        name="pass2" size="10"
        maxlength="20"
        value="<?php
            if (isset($_POST['pass2'])) echo $_POST['pass2'];
        ?>">
    </label></p>
    <p><input
        type="submit"
        name="submit"
        value="Change Password">
    </p>
</form>

<?php include('includes/footer.php');?>