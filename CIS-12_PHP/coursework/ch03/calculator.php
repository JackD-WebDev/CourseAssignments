<!-- CSC-12.43560 Jack Daly 🥷 CIS 12 Lab 3 - Updated 03/09/22 -->
<!-- In the previous version of this file values selected were reset upon submission, whereas entered values are retained in this version. -->
<!-- In the third version of this file the fuel cost radio buttons were generated programmatically via function. -->
<!-- The fourth version of this file contains a function that allows the type of radio button to be determined with a second argument. -->
<!-- The fifth iteration of the file implements a function to return the value of the trip cost as a variable. -->
<!-- Finally, the program has been updated to prevent the accidental input of negative numbers -->

<?php
function createRadio($value, $name = 'gallonPrice') {
    echo '<input type="radio"
                 name="' . $name . '"
                 value="' . $value . '"';
    if(isset($_POST[$name]) && ($_POST[$name] == $value)) {
        echo ' checked="checked"';
    }
    echo "> $value ";
}

function calculateTripCost($miles, $mpg, $ppg): string
{
    $gallons = $miles / $mpg;
    $dollars = $gallons * $ppg;
    return number_format($dollars, 2);
}

$pageTitle = 'Trip Cost Calculator';
include('includes/header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset(
        $_POST['distance'],
        $_POST['gallonPrice'],
        $_POST['efficiency'])
        && is_numeric($_POST['distance']) && ($_POST['distance'] > 0)
        && is_numeric($_POST['gallonPrice']) && ($_POST['gallonPrice'] > 0)
        && is_numeric($_POST['efficiency']) && ($_POST['efficiency'] > 0)
    ) {
        $cost = calculateTripCost($_POST['distance'], $_POST['efficiency'], $_POST['gallonPrice']);
        $hours = $_POST['distance'] / 65;

        // Print the results of the calculation
        echo '<div class="page-header"><h1>Total Estimated Cost</h1></div>
            <p>The total cost of driving ' . $_POST['distance'] . ' miles, averaging '
            . $_POST['efficiency'] . ' miles per gallon, and paying an average of $'
            . $_POST['gallonPrice'] . ' per gallon, is $' . $cost . '.
            If you drive at an average of 65 miles per hour, the trip will take approximately '
            . number_format($hours, 2) . ' hours.</p>';
    } else {
        echo '<div class="page-header"><h1>Error!</h1></div>
        <p class="text-danger">Please enter a valid distance, price per gallon, and fuel efficiency.</p>';
    }
}
?>

<div class="page-header"><h1>Trip Cost Calculator</h1></div>
<form action="calculator.php" method="post">
    <p><label><!-- Counter for Trip Distance -->
            Distance (in miles):
            <input type="number"
                   min="0"
                   name="distance"
                   value="<?php if(isset($_POST['distance'])) {
                       echo $_POST['distance'];
                   } ?>">
    </label></p>
    <p><label><!-- Radio Buttons for PPG -->
            Average Price Per Gallon:
<?php
    createRadio('3.00');
    createRadio('3.50');
    createRadio('4.00');
?>
    </label></p>
    <p><label><!-- Fuel Efficiency drop-down -->
            Fuel Efficiency: <select name="efficiency">
        <option value="10"
            <?php if(isset($_POST['efficiency'])
            && ($_POST['efficiency'] == '10')) {
            echo ' selected="selected"';
        } ?>>Terrible</option>
        <option value="20"
            <?php if(isset($_POST['efficiency'])
                && ($_POST['efficiency'] == '20')) {
                echo ' selected="selected"';
            } ?>>Decent</option>
        <option value="30"
            <?php if(isset($_POST['efficiency'])
                && ($_POST['efficiency'] == '30')) {
                echo ' selected="selected"';
            } ?>>Very Good</option>
        <option value="50"
            <?php if(isset($_POST['efficiency'])
                && ($_POST['efficiency'] == '50')) {
                echo ' selected="selected"';
            } ?>>Outstanding</option>
    </select></label></p>
    <p><input type="submit" name="submit" value="Calculate!"></p>
</form>

<?php include('includes/footer.php'); ?>
