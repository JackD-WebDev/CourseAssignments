<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/28/22

function redirect_user($page = 'index.php'): void {
    // Start defining the URL...
    $url = 'http://' . $_SERVER  ['HTTP_HOST'] . dirname  ($_SERVER['PHP_SELF']);
    // Remove any trailing slashes:
    $url = rtrim($url, '/\\');
    // Add the page:
    $url .= '/' . $page;
    // Redirect the user:
    header("Location: $url");
    exit();
}

function check_login($dbc, $email = '', $pass = ''): array
{
    $errors = [];
    // Validate the email address:
    if(empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($email));
    }

    // Validate the password:
    if(empty($pass)) {
        $errors[] = 'You forgot to enter your password.';
    } else {
        $p = trim($pass);
    }

    if(empty($errors)) {
        // Retrieve the user_id and  first_name for that email/password combination:
        /** @noinspection PhpUndefinedVariableInspection */
        $q = "SELECT user_id, first_name, pass FROM `users` WHERE email='$e'";
        $r = @mysqli_query($dbc, $q);
        // Check the result:
        if(mysqli_num_rows($r) == 1) {
            // Fetch the record:
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
            // Check the password:
            if (password_verify($p, $row['pass'])) {
                unset($row['pass']);
                return [true, $row];
            } else {
                $errors[] = 'The email address and password entered do not match those on file.';
            }
        } else {
            $errors[] = 'The email address  and password entered do not  match those on file.';
        }
    }
    return [false, $errors];
}