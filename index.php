<?php
	require_once "/settings.php";
	require_once "/classes/PageRouter.php";
	
	unset($_SESSION["errors"]);
	unset($_SESSION["success"]);
	
	$pageRouter = new PageRouter($_SERVER["REQUEST_URI"]);
?>