<?php

if (isset($_POST['submit'])) {

	require_once("connect.php");

	$first = mysqli_real_escape_string($link, $_POST['fname']);
	$last = mysqli_real_escape_string($link, $_POST['lname']);
	$username = mysqli_real_escape_string($link, $_POST['name']);
	$password = mysqli_real_escape_string($link, $_POST['password']);

	//Error handling if user did not fill in form correctly
	//no empty fields
	if (empty($first) || empty($last) || empty($username) || empty($password)) {
				//run error checking before function
			header("Location: ../admin_signup.php?signup=empty");
			exit();
	} else {
		//Check if variable $first,  $last includes these letters
		if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			header("Location: ../admin_signup.php?signup=invalidcharacter");
			exit();

		} else {
			$sql = "SELECT * FROM tbl_user WHERE user_name='$username'";
			$result = mysqli_query($link, $sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck > 0) {
				header("Location: ../admin_signup.php?signup=usernametaken");
				exit();

			} else {
				//encrpyting the password
				$secretpassword = password_hash($password, PASSWORD_DEFAULT);
				//insert the user into the databasse
				$sql = "INSERT INTO tbl_user (user_fname, user_lname, user_name, user_pass) VALUES ('$first', '$last', '$username', '$secretpassword');";
				mysqli_query($link, $sql);
				header("Location: ../admin_signup.php?signup=SUCCESS");
				exit();
			}
		}
	}

} else {
	header("Location: ../signup.php");
	exit();
}

?>