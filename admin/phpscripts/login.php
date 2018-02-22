<?php
	function logIn($username, $password, $ip) {
		require_once("connect.php");
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);

		$loginString = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
		$user_set = mysqli_query($link, $loginString);
		

		$lockoutString = "SELECT * FROM tbl_user WHERE user_name = '$username' OR user_pass = '$password'"; 
		$result = mysqli_query($link, $lockoutString); 
		$matchFound = mysqli_num_rows($result); 

		if($matchFound < 2) { 
			$updateLogin = "UPDATE tbl_user SET user_loginAttempts = user_loginAttempts + 1 WHERE user_ip = '$ip'";
			$updateLoginQuery = mysqli_query($link, $updateLogin);

			$attemptsString = "SELECT user_loginAttempts FROM tbl_user WHERE user_ip ='$ip' AND user_loginAttempts >= '3'"; 
			$attemptsQuery = mysqli_query($link, $attemptsString);
			$threeAttempts = mysqli_num_rows($attemptsQuery);
			
			if($threeAttempts == "1") { 
				echo 'You have reached 3 failed login attempts.';
			}

		}elseif($matchFound = 2) { 
			$updateLogin = "UPDATE tbl_user SET user_loginAttempts = '0' WHERE user_ip = '$ip'"; 

			$updateLoginQuery = mysqli_query($link, $updateLogin);
		}


		if(mysqli_num_rows($user_set)) {
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $found_user['user_id'];
			$_SESSION['users_id'] = $id;
			$_SESSION['users_name'] = $found_user['user_name'];
			$_SESSION['users_fname'] = $found_user['user_fname'];
			if(mysqli_query($link, $loginString)) {
				$updateString = "UPDATE tbl_user SET user_ip = '{$ip}' WHERE user_id = {$id}";
				$updateQuery = mysqli_query($link, $updateString);

				
				date_default_timezone_set('America/Toronto'); 
				$currentDate = date('l F jS Y, \a\t h:ia T'); 
				$_SESSION['current_hour'] = date('G');
				$updateTime = "UPDATE tbl_user SET user_timestamp = '$currentDate' WHERE user_id = {$id}"; 
				$updateTimeQuery = mysqli_query($link, $updateTime);
				$timestamp = $found_user['user_timestamp']; 
				$_SESSION['users_timestamp'] = $timestamp; 
			}
			redirect_to("admin_index.php");
		}else{
			$message = "Username/Password incorrect.";
			return $message;

		}
		mysqli_close($link);
	}
?>