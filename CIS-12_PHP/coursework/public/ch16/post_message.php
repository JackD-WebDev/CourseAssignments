<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 06/04/22
-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post a Message</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate the data (omitted)!
    // Connect to the database:
    $mysqli = new MySQLi('mysql', 'root', 'secret', 'forum');
    $mysqli->set_charset('utf8');
    // Make the query:
    $q = 'INSERT INTO `messages` (forum_id, parent_id, user_id, subject, body,  date_entered) VALUES (?, ?, ?, ?, ?, NOW())';

    // Prepare the statement:
    $stmt = $mysqli->prepare($q);

    // Bind the variables:
    $stmt->bind_param('iiiss', $forum_id, $parent_id, $user_id, $subject,  $body);

    // Assign the values to variables:
    $forum_id = (int) $_POST['forum_id'];
    $parent_id = (int) $_POST['parent_id'];
    $user_id = 3; // The user_id value would normally come from the session.
    $subject = strip_tags($_POST['subject']);
    $body = strip_tags($_POST['body']);

    // Execute the query:
    $stmt->execute();

    // Print a message based upon the result:
    if ($stmt->affected_rows == 1) {
        echo '<p>Your message has been posted.</p>';

    } else {
        echo '<p style="font-weight: bold; color: #C00">Your message could not be posted.</p>';
        echo '<p>' . $stmt->error . '</p>';
    }

    $stmt->close();
    unset($stmt);
    $mysqli->close();
    unset($mysqli);
}
?>

<form action="post_message.php" method="post">
    <fieldset><legend>Post a message:</legend>
        <p><label><strong>Subject</strong>: <input name="subject" type="text" size="30" maxlength="100"></label></p>
        <p><label><strong>Body</strong>: <textarea name="body" rows="3" cols="40"></textarea></label></p>
    </fieldset>
    <!--suppress HtmlDeprecatedAttribute -->
    <div align="center"><input type="submit" name="submit" value="Submit"></div>
    <input type="hidden" name="forum_id" value="1">
    <input type="hidden" name="parent_id" value="0">
</form>
</body>
</html>