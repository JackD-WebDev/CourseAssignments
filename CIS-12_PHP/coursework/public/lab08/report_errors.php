<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 04/29/22
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reporting Errors</title>
</head>
<body>
<h1>Testing Error Reporting</h1>

<?php
// Show errors:
ini_set('display_errors', 1);

// Adjust error reporting:
error_reporting(0);


// Create errors:
foreach ($var as $v) {}
$result = 1/0;
?>

<body>
</html>
