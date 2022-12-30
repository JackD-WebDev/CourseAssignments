<?php
	
	include("functions.php");
	
	$email = $_POST['email'];
	$pass = $_POST['password'];

	if ($_GET['action'] == "loginSignup") {
		$error = "";
		if (!$email) {
			$error= "An email address is required";
		} else if (!$pass) {
			$error= "A password is required";
		} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$error= "Please enter a valid email address";
		}
		if ($error != "") {
			echo $error;
			exit();
		}
        $query = "SELECT * FROM `users` WHERE email = '". mysqli_real_escape_string($dbc, $email)."' LIMIT 1";
        $result = mysqli_query($dbc, $query);
        if($_POST['loginActive'] == "0") {

            if (mysqli_num_rows($result) > 0) $error = "That email address is already registered.";
			else {
			
				$query = "INSERT INTO `users` (`email`, `password`) VALUES ('". mysqli_real_escape_string($dbc, $email)."', '". mysqli_real_escape_string($dbc, $pass)."')";
				
				if (mysqli_query($dbc, $query)) {
					
					$_SESSION['id'] = mysqli_insert_id($dbc);
					$id_pass = $_SESSION['id'].$pass;
					$query = "UPDATE `users` SET password = '". password_hash($id_pass, PASSWORD_DEFAULT) ."' WHERE id = ".$_SESSION['id']." LIMIT 1";
					mysqli_query($dbc, $query);
					
					echo 1;
					
				} else {
					
					$error = "Unable to add user - please try again later.";
				}
				
			}
			
		} else {

            $row = mysqli_fetch_assoc($result);
			$row_pass = $row['id'].$pass;
			$r_pass = $row['password'];
				
				if (password_verify($row_pass, $r_pass)) {
				
				echo 1;
				$_SESSION['id'] = $row['id'];
					
				} else {
					
					$error = "Unable to find that email / password. Please try again.";
				}
		} 
		if ($error != "") {
			echo $error;
			exit();
		}
	}
	if ($_GET['action'] == 'toggleFollow') {
		$query = "SELECT * FROM `isfollowing` WHERE follower = ". mysqli_real_escape_string($dbc, $_SESSION['id'])." AND isfollowing = ". mysqli_real_escape_string($dbc, $_POST['userId'])." LIMIT 1";
			$result = mysqli_query($dbc, $query);
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				mysqli_query($dbc, "DELETE FROM `isfollowing` WHERE id = ". mysqli_real_escape_string($dbc, $row['id'])." LIMIT 1");
				echo "1";
			} else {
				mysqli_query($dbc, "INSERT INTO `isfollowing` (follower, isfollowing) VALUES (". mysqli_real_escape_string($dbc, $_SESSION['id']).", ". mysqli_real_escape_string($dbc, $_POST['userId']).")");
				echo "2";
			}
	}

	if ($_GET['action'] == 'submitPost') {
		if (!$_POST['postContent']) {
			echo "TRY TYPING SOMETHING FIRST";
		} else if (strlen($_POST['postContent']) > 300) {
			echo "YOUR POST IS TOO LONG";
		} else {
			mysqli_query($dbc, "INSERT INTO `posts` (`post`, `userid`, `datetime`) VALUES ('". mysqli_real_escape_string($dbc, $_POST['postContent'])."', ". mysqli_real_escape_string($dbc, $_SESSION['id']).", NOW())");
			echo "1";
		}
	}

?>