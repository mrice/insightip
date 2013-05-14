<?php

if (!file_exists("./config.php")) {
	header("Location: /setup");
	end;
}
require("./config.php");
if (!validate_db_connection()) {
	header("Location: /offline.php");
	end;
}


function validate_db_connection() {
	global $dbHost, $dbUser, $dbPassword, $dbDatabase;
	$result = false;
	$conn = mysql_connect($dbHost, $dbUser, $dbPassword);
	if ($conn) {
		$connected = mysql_select_db($dbDatabase);
		if ($connected) {
			$result = true;
		}
		mysql_close($conn);
	}
	return $result;
}

function open_connection() {
	global $dbHost, $dbUser, $dbPassword, $dbDatabase;
	$conn = mysql_connect($dbHost, $dbUser, $dbPassword);
	$connected = mysql_select_db($dbDatabase);
	return $conn;
}
?>