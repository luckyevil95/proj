<?php
	class AddPostModel
	{
		public function addPost($args)
		{
			global $CONNECT;
			
			$user_agent = $_SERVER["HTTP_USER_AGENT"];
	
			if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
			elseif (strpos($user_agent, "Opera") !== false || strpos($user_agent, "OPR") !== false) $browser = "Opera";
			elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
			elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
			elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
			else $browser = "Невідомий";
			
			mysqli_query($CONNECT, "INSERT INTO `" . DB . "`.`posts` (`name`, `email`, `url`, `text`, `ip`, `browser`, `date`) VALUES ('" . mysql_real_escape_string($args["name"]) . "', '" . $args["email"] . "', '" . $args["url"] . "', '" . mysql_real_escape_string($args["text"]) . "', '" . $_SERVER["REMOTE_ADDR"] . "', '". $browser ."', NOW())");
		}
	}
?>