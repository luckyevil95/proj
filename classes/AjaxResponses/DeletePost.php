<?php
	class DeletePost
	{
		private $CONNECT;
		
		public function DeletePost()
		{
			global $CONNECT;
			
			$this->CONNECT = $CONNECT;
			
			$this->delete();
		}
		
		private function delete()
		{
			if (!$_SESSION["isModerator"]) exit("У вас немає прав на видалення повідомлень");
			
			mysqli_query($this->CONNECT, "DELETE FROM `" . DB . "`.`posts` WHERE `posts`.`id` = '" . $_POST["id"] . "'");
		}
		
		public function returnResponse()
		{
			return "success";
		}
	}
?>