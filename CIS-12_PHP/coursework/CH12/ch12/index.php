<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 04/30/22

function createAd() : void {
    echo '<div class="alert alert-info" role="alert"><p>
        This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!
    </p></div>';
}

$pageTitle = 'Welcome to this site!';
include('includes/header.php');
createAd();
?>

    <div class="page-header">
        <h1>Content Header</h1>
    </div>
    <p>CONTENT</p>
    <p>Words and stuff</p>

<?php
createAd();
require('includes/footer.php');
?>