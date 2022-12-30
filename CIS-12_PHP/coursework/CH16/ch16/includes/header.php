<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 06/04/22
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle ?? 'Page Title'; ?></title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navbar navbar-default nav-bar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Your Website</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php">Home</a>
                </li>
                <li><a href="register.php">Register</a></li>
                <li><a href="view_users.php">View Users</a></li>
                <li><a href="post_message.php">Post a Message</a></li>
                <li><a href="datetime.php">Date & Time</a></li>
                <li><a href="password.php">Change Password</a></li>
                <li>
<?php // Create a login/logout link:
if( isset($_SESSION['user_id'])) {
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<a href="login.php">Login</a>';
}
?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">