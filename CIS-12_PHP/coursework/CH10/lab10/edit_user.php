<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/06/22

$pageTitle = 'Edit a User';
include('includes/header.php');

echo '<h1>Edit a User</h1>';

// Check for a valid user ID, through GET or POST:
if((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
} elseif((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
    include('includes/footer.php');
    exit();
}

require('../../my_sqli_connect.php');

// Check if the form has been submitted:
if($_SERVER['REQUEST_METHOD'] ==  'POST') {
    $errors = [];
    // Check for a first name:
    if(empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter  your first name.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $fn = mysqli_real_escape_string($dbc, trim($_POST ['first_name']));
    }
    // Check for a last name:
    if(empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter  your last name.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    }
    // Check for an email address:
    if(empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        /** @noinspection PhpUndefinedVariableInspection */
        $e = mysqli_real_escape_string  ($dbc, trim($_POST['email']));
    }
    if(empty($errors)) {
        // Test for unique email address:
        /** @noinspection PhpUndefinedVariableInspection */
        $q = "SELECT user_id FROM `users`  WHERE email='$e' AND user_id !=  $id";
        /** @noinspection PhpUndefinedVariableInspection */
        $r = @mysqli_query($dbc, $q);

        if(mysqli_num_rows($r) == 0) {
            // Make the query:
            /** @noinspection PhpUndefinedVariableInspection */
            $q = "UPDATE `users` SET first_name='$fn', last_name='$ln', email='$e'
            WHERE user_id=$id LIMIT 1";
            $r = @mysqli_query($dbc, $q);

            if(mysqli_affected_rows($dbc) == 1) {
                // Print a message:
                echo '<p>The user has been edited.</p>';
            } else {
                // Public message.
                echo '<p class="error">The user could not be edited due to a system error.  We apologize for any inconvenience.</p>';
                // Debugging message.
                echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
            }
        } else {
            echo '<p class="error">The email address has already been registered.</p>';
        }
    } else {
        echo '<p class="error">The following error(s) occurred:<br>';
        foreach($errors as $msg) {
            echo " - $msg<br>\n";
        }
        echo '</p><p>Please try again.</p>';
    }
}

// Retrieve the user's information:
$q = "SELECT first_name, last_name, email FROM `users` WHERE user_id=$id";
/** @noinspection PhpUndefinedVariableInspection */
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) {
    // Get the user's information:
    $row = mysqli_fetch_array($r,  MYSQLI_NUM);
    // Create the form:
    echo '<form action="edit_user.php" method="post">
        <p>First Name: <input
            type="text" 
            name="first_name"
            size="15"
            maxlength="15" 
            value="' . $row[0] .  '">
        </p>
        <p>Last Name: <input
            type="text" 
            name="last_name"
            size="15"
            maxlength="30"
            value="' . $row[1] .  '">
        </p>
        <p>Email Address: <input
            type="email" 
            name="email"
            size="20"
            maxlength="60" 
            value="' . $row[2] . '">
        </p>
        <p><input
            type="submit"
            name="submit" 
            value="Submit">
        </p>
        <input
            type="hidden"
            name="id"
            value="' . $id . '">
    </form>';
} else {
    echo '<p class="error">This page has  been accessed in error.</p>';
}

mysqli_close($dbc);
include('includes/footer.php');
?>


