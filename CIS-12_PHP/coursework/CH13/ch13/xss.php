<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/28/22
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>XSS Attacks</title>
</head>
<body>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Apply the different functions, printing the results:
    echo "<h2>Original</h2><p>{$_POST['data']}</p>";
    echo '<h2>After htmlentities()</h2><p>' . htmlentities($_POST['data']). '</p>';
    echo '<h2>After strip_tags()</h2><p>' . strip_tags($_POST['data']). '</p>';
}
?>
<form action="xss.php" method="post">
    <p><label>Do your worst! <textarea name="data" rows="3" cols="40"></textarea></label></p>
    <div align="center">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>
</body>
</html>