<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 03/04/22
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Form Feedback</title>
    <style title="text/css" media="all">
        .error {
            font-weight: bold;
            color: #C00;
        }
    </style>
</head>
<body>

<?php # handle_form.php

    // Validate name
    $name = $_REQUEST['name'] ?? null;
    if($name == null) {
        echo '<p class="error">You forgot to enter your name!</p>';
    }

    // Validate email
    $email = $_REQUEST['email'] ?? null;
    if($email == null) {
        echo '<p class="error">You forgot to enter your email address!</p>';
    }

    // Validate comments
    $comments = $_REQUEST['comments'] ?? null;
    if($comments == null) {
        echo '<p class="error">You forgot to enter your comments!</p>';
    }

    // Validate gender
    if(isset($_REQUEST['gender'])) {
        $gender = $_REQUEST['gender'];
        if($gender == 'M') {
            $greeting = '<p><strong>Good day, Sir!</strong></p>';
        } elseif($gender == 'F') {
            $greeting = '<p><strong>Good day, Madam!</strong></p>';
        } else {
            $gender = null;
            echo '<p class="error">Sorry, but we are unable to accommodate inclusivity options at this time.</p>;';
        }
    } else {
        $gender = null;
        echo '<p class="error">Please select a gender.</p>';
    }

    // Validation successful
    if($name && $email && $gender && $comments) {
        echo "<p>Thank you, <strong>$name</strong>, for the following comments:</p>
        <pre>$comments</pre>
        <p>We will reply to you at <em>$email</em>.</p>\n";

        echo $greeting ?? '';
    } else {
        echo '<p class="error">Please go back and fill out the form again.</p>';
    }
?>
</body>
</html>