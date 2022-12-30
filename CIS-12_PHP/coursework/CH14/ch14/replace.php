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
    $replace = trim($_POST['replace']);

    // Print a caption:
    echo "<p>The result of checking<br><strong>$pattern</strong><br>against<br>$subject<br>is: ";

    // Check for a match:
    if(preg_match($pattern, $subject)) {
        echo preg_replace($pattern, $replace, $subject) . '</p>';
    } else {
        echo 'The pattern was not found!</p>';
    }
}
?>

<form action="replace.php" method="post">
    <p><label>Regular Expression Pattern: <input
        type="text"
        name="pattern"
        value="<?php if(isset($pattern)) echo htmlentities($pattern); ?>"
        size="40">
    </label> (include the delimiters)</p>
    <p><label>Replacement: <input
        type="text"
        name="replace"
        value="<?php if(isset($replace)) echo htmlentities($replace); ?>"
        size="40">
    </label></p>
    <p><label>Test Subject: <textarea
        name="subject"
        rows="5"
        cols="40"><?php if(isset($subject)) echo htmlentities($subject); ?></textarea>
    </label></p>
    <input
        type="submit"
        name="submit"
        value="Test!">
</form>
</body>
</html>
