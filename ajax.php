<?php
	require_once "/settings.php";
	require_once "/classes/AjaxRouter.php";
	
	$ajaxRouter = new AjaxRouter($_POST["type"]);
?>