<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CIS12 Lab 1</title>
    <link href="../../setup/assets/styles/css/reset.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- CSC-12.43560 Jack Daly 🥷 Updated 02/26/22 -->
    <p>This is standard HTML.</p>

    <?php
    #Part 1 Predefined Variables
    $file = $_SERVER['SCRIPT_FILENAME'];
    $user = $_SERVER['HTTP_USER_AGENT'];
    $server = $_SERVER['SERVER_SOFTWARE'];

    // Print the name of this script:
    echo "<p>You are running the file:<br><strong>$file</strong>.</p>\n";
    // Print the user's information:
    echo "<p>You are viewing this page using:<br><strong>$user</strong></p>\n";
    // Print the server's information:
    echo "<p>This server is running:<br><strong>$server</strong>.<p>\n";


    // Create the variables:
    $first_name = 'Jack';
    $last_name = 'Daly';
    $whole_name = $first_name . ' ' . $last_name;
    $movie = 'Stock, Lock & Two Smoking Barrels';

    //Print the values:
    echo "<p>My name is <b>$whole_name</b> and my favorite movie is <em>$movie</em>.</p>";

    // Set the variables:
    $quantity = 30;
    $price = 119.95;
    $taxRate = .05;

    // Calculate the total:
    $total = $quantity * $price;
    $total = $total + ($total * $taxRate);

    // Format the total:
    $total = number_format($total, 2);

    // Print the results:
    echo '<p>You are purchasing <strong>' . $quantity . '</strong>
    widget(s) at a cost of <strong>$' . $price . '</strong> each.
    With tax, the total comes to <strong>$' . $total . '</strong>.</p>';

    // Set today's date as a constant:
    const TODAY = 'February 25, 2022'; // My IDE does not approve of "define." 👌

    // Print a message, using predefined constants and the TODAY constant
    echo '<p>Today is ' . TODAY . '.<br>This server is running
    version <strong>' . PHP_VERSION . '</strong> of PHP on the
    <strong>' . PHP_OS . '</strong> operating system.</p>';

    ?>

</body>
</html>