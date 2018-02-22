<?php
	require_once('config.php');

	if(isset($_GET['caller_id'])) {
		$dir = $_GET['caller_id'];
		//echo $dir;
		if($dir == "logout") {
			logged_out();
		}
	}
?>