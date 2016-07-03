<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $_SESSION["pageinfo"]["title"]; ?></title>
		<link href="/css/style.css" rel="stylesheet" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="/js/script.js"></script>
	</head>
	<body>
		<script>isModerator = <?php if ($_SESSION["isModerator"]) echo $_SESSION["isModerator"]; else echo 0?>;</script>
	
		<div class="header">
			<div class="menu">
				<a href="/"><div class="menuItem">Головна</div></a>
				<a href="/add-post/"><div class="menuItem">Додати повідомлення</div></a>
				
				<?php
					if ($_SESSION["isModerator"] == 1)
						echo "<a href='/output/'><div class='menuItem'>Вихід</div></a>";
					else
						echo "<a href='/input/'><div class='menuItem'>Вхід</div></a>";
				?>
			</div>
		</div>