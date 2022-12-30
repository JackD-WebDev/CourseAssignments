<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 04/29/22
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Displaying Errors</title>
</head>
<body>
    <h1>Testing Display Errors</h1>

<?php
    // Show errors:
    ini_set('display_errors', 0);

    // Create errors:
    foreach ($var as $v) {}
    $result = 1/0;
?>

<body>
</html>
