<?php
	class PageRouter
	{
		public function PageRouter($url)
		{
			global $CONNECT;
			
			$url = parse_url($url);
			$strlenUrl = strlen($url["path"]);
			
			if ($url["path"][$strlenUrl - 1] != "/")
			{
				header("Location: " . $url["path"] . "/");
				exit();
			}
			
			$page = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `pages` WHERE `url` = '" . $url["path"] . "'"));
			
			if ($page)
			{
				$_SESSION["pageinfo"] = array("title" => $page["title"]);
				
				require_once "./templates/" . $page["template"];
			}
			else
				header("Location: /");
		}
	}
?>