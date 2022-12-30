<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 03/08/22

function createAd() {
    echo '<div class="alert alert-info" role="alert"><p>
        This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!
    </p></div>';
}

$pageTitle = 'Welcome to this site!';
include('includes/header.php');
createAd();
?>

<!-- This version has been updated to include two banners of "annoying ads" rendered via function. -->
    <div class="page-header">
        <h1>Content Header</h1>
    </div>
    <p>CONTENT</p>
    <p>Words and stuff</p>

<?php
createAd();
require('includes/footer.php');
?>