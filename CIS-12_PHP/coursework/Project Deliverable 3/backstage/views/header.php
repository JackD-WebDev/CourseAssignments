<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Backstage</title>
	<link href="styles/css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
	<div class="logo-box, canister">
		<a class="logoHome" href="index.php">
			<div class="logo">
			<h1 class="pageTitle">Backstage</h1>
			</div>
		</a>
	</div>
	<nav class="navPrime">
		<ul>
			<li class="button"><a href="?page=feed">FEED</a></li>
			<li class="button"><a href="?page=yourposts">YOUR POSTS</a></li>
			<li class="button"><a href="?page=timeline">TIMELINE</a></li>
			<li class="button"><a href="?page=publicprofiles">PUBLIC PROFILES</a></li>
			<li id="logInOut">
                <?php if(isset($_SESSION['id'])) { ?>
                    <a class="button" href="..?function=logout">LOGOUT</a>
                <?php } else { ?>
                    <div class="button" id="signupLogin">SIGN UP / LOG IN</div>
                <?php } ?>
			</li>
		</ul>		
	</nav>
</header>
