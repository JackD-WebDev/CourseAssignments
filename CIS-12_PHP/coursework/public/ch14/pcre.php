<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 06/03/22
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Testing PCRE</title>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim the strings:
    $pattern = trim($_POST['pattern']);
    $subject = trim($_POST['subject']);

    // Print a caption:
    echo "<p>The result of checking<br><strong>$pattern</strong><br>against<br>$subject<br>is: ";

    // Test:
    if(preg_match($pattern, $subject)) {
        echo 'TRUE!</p>';
    } else {
        echo 'FALSE!</p>';
    }
}
?>

<form action="pcre.php" method="post">
    <p><label>Regular Expression Pattern: <input
        type="text"
        name="pattern"
        value="<?php if(isset($pattern)) echo htmlentities($pattern); ?>"
        size="40">
    </label> (include the delimiters)</p>
    <p><label>Test Subject: <input
        type="text"
        name="subject"
        value="<?php if(isset($subject)) echo htmlentities($subject); ?>"
        size="40">
    </label></p>
    <input
        type="submit"
        name="submit"
        value="Test!">
</form>
</body>
</html>
