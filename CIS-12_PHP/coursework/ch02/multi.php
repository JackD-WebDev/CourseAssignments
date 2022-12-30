<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Multidimensional Arrays</title>
</head>
<body>
<!-- CSC-12.43560 Jack Daly 🥷 Updated 03/05/22 -->
<p>Some North American States, Provinces, and Territories:</p>

<?php # multi.php

$mexico = [
    'YU' => 'Yucatan',
    'BC' => 'Baja California',
    'OA' => 'Oaxaca'
];

$us = [
    'MD' => 'Maryland',
    'IL' => 'Illinois',
    'PA' => 'Pennsylvania',
    'IA' => 'Iowa'
];

$canada = [
    'QC' => 'Quebec',
    'AB' => 'Alberta',
    'NT' => 'Northwest Territories',
    'YT' => 'Yucatan',
    'PE' => 'Prince Edward Island'
];

$nAmerica = [
    'Mexico' => $mexico,
    'United States' => $us,
    'Canada' => $canada
];

foreach($nAmerica as $country => $list) {
    echo "<h2>Country</h2><ul>";

    foreach($list as $k => $v) {
        echo "<li>$k - $v</li>\n";
    }
    echo '</ul>';
}

?>
</body>
</html>
