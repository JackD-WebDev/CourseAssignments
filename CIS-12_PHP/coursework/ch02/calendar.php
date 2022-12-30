<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Calendar</title>
</head>
<body>
<!-- CSC-12.43560 Jack Daly 🥷 Updated 03/05/22 -->
<form action="handle_form.php"
      method="post">
<?php # calendar.php

$months = [1 => 'January', 'February',
    'March', 'April', 'May', 'June',
    'July', 'August', 'September',
    'October', 'November', 'December'];
$days = range(1, 31);
$years = range(2017, 2027);

// Months dropdown
echo '<select name="month">';
foreach($months as $key => $value) {
    echo "<option value=\"$value\">
    $value</option>\n";
}
echo '</select>';

// Days dropdown
echo '<select name="day">';
for($day = 1; $day <= 31; $day++) {
    echo "<option value=\"$day\">
    $day</option>\n";
}
echo '</select>';

// Year dropdown
echo '<select name="year">';
for($year = 2017; $year <= 2027; $year++) {
    echo "<option value=\"$year\">
    $year</option>\n";
}
echo '</select>';
?>
</form>
</body>
</html>
