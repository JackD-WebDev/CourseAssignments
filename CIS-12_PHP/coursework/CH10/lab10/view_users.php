<?php /** @noinspection HtmlDeprecatedAttribute */
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/07/22

$pageTitle = 'View the Current Users';
include('includes/header.php');
echo '<h1>Registered Users</h1>';
require_once('../../my_sqli_connect.php');

$display = 10;
// Determine how many pages there are...
if(isset($_GET['p']) && is_numeric($_GET['p'])) {
    $pages = $_GET['p'];
} else {
    // Count the number of records:
    $q = "SELECT COUNT(user_id) FROM `users`";
    /** @noinspection PhpUndefinedVariableInspection */
    $r = @mysqli_query($dbc, $q);
    $row = @mysqli_fetch_array($r, MYSQLI_NUM);
    $records = $row[0];

    // Calculate the number of pages...
    if($records > $display) {
        $pages = ceil($records/$display);
    } else {
        $pages = 1;
    }
}

// Determine where in the database to start returning results...
if(isset($_GET['s']) && is_numeric($_GET['s'])) {
    $start = $_GET['s'];
} else {
    $start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch($sort) {
    case 'ln':
        $order_by = 'last_name ASC';
    break;
    case 'fn':
        $order_by = 'first_name ASC';
    break;
    case 'rd':
        $order_by = 'registration_date ASC';
    break;
    default:
        $order_by = 'registration_date ASC';
        $sort = 'rd';
    break;
}

// Define the query:
$q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr,
    user_id FROM `users`
    ORDER BY $order_by
    LIMIT $start, $display";
/** @noinspection PhpUndefinedVariableInspection */
$r = @mysqli_query($dbc, $q);

// Table header:
echo '<table width="60%">
    <thead>
        <tr>
            <th align="left">
                <strong>Edit</strong>
            </th>
            <th align="left">
                <strong>Delete</strong>
            </th>
            <th align="left">
                <strong><a href="view_users.php?sort=ln">Last Name</a></strong></th>
            <th align="left">
                <strong><a href="view_users.php?sort=fn">First Name</a></strong></th>
            <th align="left">
                <strong><a href="view_users.php?sort=rd">Date Registered</a></strong></th>
            </tr>
        </thead>
    <tbody>
';

// Fetch and print all the records...
$bg = '#eeeeee';
while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
    echo '
        <tr bgcolor="' . $bg . '">
            <td align="left">
                <a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a>
            </td>
            <td align="left">
                <a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a>
            </td>
            <td align="left">' . $row['last_name'] . '</td>
            <td align="left">' . $row['first_name'] . '</td>
            <td align="left">' . $row['dr'] . '</td>
        </tr>
    ';
}
echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if($pages > 1) {
    echo '<br><p>';
    // Determine what page the script is on:
    $current_page = ($start/$display) + 1;
    // If it's not the first page, make a Previous button:
    if($current_page != 1) {
        echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages .
            '&sort=' . $sort . '">Previous</a> ';
    }
    // Make all the numbered pages:
    for($i = 1; $i <= $pages; $i++) {
        if($i != $current_page) {
            echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages .
                '&sort=' . $sort . '">' . $i . '</a> ';
        } else {
            echo $i . ' ';
        }
    }
    // If it's not the last page, make a Next button:
    if($current_page != $pages) {
        echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages .
            '&sort=' . $sort . '">Next</a>';
    }
    echo '</p>';
}

include('includes/footer.php');
?>