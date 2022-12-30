<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 05/14/22
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Images</title>
    <script charset="utf-8" src="js/function.js"></script>
</head>
<body>
<p>Click on an image to view it in a separate window.</p>
<ul>

<?php
    // Set the default timezone:
    date_default_timezone_set('America/Los_Angeles');
    $dir = '../uploads/tmp';
    $files = scandir($dir);
    // Display each image caption as a link to the JavaScript function:
    foreach ($files as $image) {
        if (substr($image, 0, 1) != '.') {
            // Get the image's size in pixels:
            $image_size = getimagesize("$dir/$image");
            // Calculate the image's size in kilobytes:
            $file_size = round( (filesize("$dir/$image")) / 1024) . "kb";
            // Determine the image's upload date and time:
            $image_date = date("F d, Y H:i:s", filemtime("$dir/$image"));
            // Make the image's name URL-safe:
            $image_name = urlencode($image);
            // Print the information:
            echo "<li><a href=\"javascript:create_window('$image_name',$image_size[0],  $image_size[1])\">$image</a> $file_size ($image_date)</li>\n";
        }
    }
?>

</ul>
</body>
</html>