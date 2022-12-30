 <?php
 // Jack Daly 🥷
 // CSC 12-43560
 // Updated 05/06/22

 $pageTitle = 'Delete a User';
 include('includes/header.php');

 echo '<h1>Delete a User</h1>';

 // Check for a valid user ID, through GET or POST:
 if((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
 } elseif((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
 } else {
     echo '<p class="error">This page has been accessed in error.</p>';
     include('includes/footer.php');
     exit();
 }

 require('../../my_sqli_connect.php');

 // Check if the form has been submitted:
 if($_SERVER['REQUEST_METHOD'] == 'POST') {
     if($_POST['sure'] == 'Yes') {
         // Make the query:
         $q = "DELETE FROM `users` WHERE user_id=$id LIMIT 1";
         /** @noinspection PhpUndefinedVariableInspection */
         $r = @mysqli_query($dbc, $q);
         if(mysqli_affected_rows($dbc) == 1) {
             // Print a message:
             echo '<p>The user has been deleted.</p>';
         } else {
             // Public message.
             echo '<p class="error">The user could not be deleted due to a system error.</p>';
             // Debugging message.
             echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
         }
     } else {
         echo '<p>The user has NOT been deleted.</p>';
     }
 } else {
     // Retrieve the user's information:
     $q = "SELECT CONCAT(last_name, ', ', first_name) FROM `users` WHERE user_id=$id";
     /** @noinspection PhpUndefinedVariableInspection */
     $r = @mysqli_query($dbc, $q);

     if(mysqli_num_rows($r) == 1) {
         // Get the user's information:
         $row = mysqli_fetch_array($r, MYSQLI_NUM);
         // Display the record being deleted:
         echo "<h3>Name: $row[0]</h3>
            Are you sure you want to delete this user?";
         // Create the form:
         echo '<form action="delete_user.php" method="post">
                <input
                    type="radio"
                    name="sure"
                    value="Yes"> Yes
                <input
                    type="radio"
                    name="sure"
                    value="No"
                    checked="checked"> No
                <input
                    type="submit"
                    name="submit"
                    value="Submit">
                <input type="hidden"
                    name="id"
                    value="' . $id . '">
            </form>';
     } else {
         echo '<p class="error">This page has been accessed in error.</p>';
     }
 }

 /** @noinspection PhpUndefinedVariableInspection */
 mysqli_close($dbc);
 include('includes/footer.php');
 ?>