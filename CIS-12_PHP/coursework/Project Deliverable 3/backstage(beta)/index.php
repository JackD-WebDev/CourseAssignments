<?php
    include("views/header.php");
	include("controls/functions.php");

	if ($_GET['page'] == 'timeline') {
		include("views/timeline.php");
	} else if ($_GET['page'] == 'yourposts') {
		include("views/yourposts.php");
	} else if ($_GET['page'] == 'search') {
		include("views/search.php");
	} else if ($_GET['page'] == 'publicprofiles') {
		include("views/publicprofiles.php");
	} else {
		include("views/feed.php");
	} 
	include("views/footer.php");
?>