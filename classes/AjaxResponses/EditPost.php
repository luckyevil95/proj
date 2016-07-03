<?php
	class EditPost
	{
		private $CONNECT;
		
		public function EditPost()
		{
			global $CONNECT;
			
			$this->CONNECT = $CONNECT;
			
			$this->edit();
		}
		
		private function edit()
		{
			if (!$_SESSION["isModerator"]) exit("У вас немає прав на видалення повідомлень");
			
			mysqli_query($this->CONNECT, "UPDATE `" . DB . "`.`posts` SET `name` = '" . $_POST["name"] . "', `email` = '" . $_POST["email"] . "', `url` = '" . $_POST["url"] . "', `text` = '" . $_POST["text"] . "', `ip` = '" . $_POST["ip"] . "', `browser` = '" . $_POST["browser"] . "', `date` = '" . $_POST["date"] . "' WHERE `posts`.`id` = '" . $_POST["id"] . "'");
		}
		
		public function returnResponse()
		{
			return "success";
		}
	}
?>