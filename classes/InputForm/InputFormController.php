<?php
	ob_start();
	
	class InputFormController
	{
		public function InputFormController($model)
		{
			$this->initFormController($model);
		}
		
		private function initFormController($model)
		{
			if (!$_POST) return;
			
			$this->validateForm($model);
		}
		
		private function validateForm($model)
		{
			global $CONNECT;
			
			$login = strip_tags(htmlspecialchars(trim($_POST["login"]), ENT_QUOTES));
			$password = strip_tags(htmlspecialchars(trim($_POST["password"]), ENT_QUOTES));
			
			$_SESSION["lastInput"] = array("login" => $login);
			
			if (empty($login)) { $_SESSION["errors"]["input"] = "Введіть логін"; return; }
			if (empty($password)) { $_SESSION["errors"]["input"] = "Введіть пароль"; return; }
			
			$trueLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `value` FROM `setting` WHERE `attribute` = 'login'"));
			$truePassword = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `value` FROM `setting` WHERE `attribute` = 'password'"));
			
			if ($login != $trueLogin["value"] || $password != $truePassword["value"])
				$_SESSION["errors"]["input"] = "Введені дані не вiрні";
			else
			{
				$model->input();
				
				unset($_SESSION["lastInput"]);
				
				header("Location: /");
			}
		}
	}
?>