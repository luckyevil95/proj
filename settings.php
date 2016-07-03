<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	session_start();
	
	define ('HOST', 'localhost');
	define ('USER', 'root');
	define ('PASS', '');
	define ('DB', 'main');

	$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
	
	mysqli_set_charset($CONNECT, "utf8");
	
	if (!$CONNECT) {
		die("Error connection: " . mysql_error());
	}
?>