<?php /** @noinspection HtmlDeprecatedAttribute */
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/01/22

$pageTitle = 'View the Current Users';

include('includes/header.php');
// Page header:
echo '<h1>Registered Users</h1>';
require('../../my_sqli_connect.php');

// Make the query:
$q = "SELECT CONCAT(last_name, ', ', first_name) AS name,
    DATE_FORMAT(registration_date,  '%M %d, %Y') AS dr
    FROM `users` ORDER BY registration_date";
/** @noinspection PhpUndefinedVariableInspection */
$r = @mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

if ($num > 0) {
    // Print how many users there are:
    echo "<p>There are currently $num registered users.</p>\n";

    // Table header.
    echo '<table width="60%">
        <thead>
            <tr>
                <th align="left">Name</th>
                <th align="left">Date Registered</th>
            </tr>
        </thead>
        <tbody>
    ';
    // Fetch and print all the records:
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] .  '</td></tr>';
    }
    echo '</tbody></table>';
    mysqli_free_result($r);
} else {
    // Public message:
    //echo '<p class="error">The current users could not be retrieved. We apologize for any  inconvenience.</p>';
    // Debugging message:
    //echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
    echo '<p class="error">There are currently no registered users.</p>';
}
mysqli_close($dbc);
include('includes/footer.php');
?>