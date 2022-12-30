<!--
// Jack Daly 🥷
// CSC 12-43560
// Updated 03/06/22
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle ?? 'Page Title'; ?></title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navbar navbar-default nav-bar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Your Website</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php">Home</a>
                </li>
                <li><a href="calculator.php">Calculator</a></li>
                <li><a href="#">Contact</a> </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">