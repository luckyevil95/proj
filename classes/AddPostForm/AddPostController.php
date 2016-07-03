<?php
	class AddPostController
	{
		public function AddPostController($model)
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
			$name = strip_tags(htmlspecialchars(trim($_POST["name"]), ENT_QUOTES));
			$email = strip_tags(htmlspecialchars(trim($_POST["email"]), ENT_QUOTES));
			$url = strip_tags(htmlspecialchars(trim($_POST["url"]), ENT_QUOTES));
			$text = strip_tags(htmlspecialchars(trim($_POST["text"]), ENT_QUOTES));
			$captcha = strip_tags(htmlspecialchars(trim($_POST["captcha"]), ENT_QUOTES));
			
			$_SESSION["lastPost"] = array("name" => $name, "email" => $email, "url" => $url, "text" => $text);
			
			if (empty($name)) { $_SESSION["errors"]["add"] = "Введіть ім&#39я"; return; }
			if (iconv_strlen($name, "UTF-8") < 3 || iconv_strlen($name, "UTF-8") > 30) { $_SESSION["errors"]["add"] = "Ім&#39я повинне бути від 3 до 30 символів"; return; }
			
			if (empty($email)) { $_SESSION["errors"]["add"] = "Введіть пошту"; return; }
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $_SESSION["errors"]["add"] =  "E-mail не коректний"; return; }
			if (iconv_strlen($email, "UTF-8") > 50) { $_SESSION["errors"]["add"] = "E-mail повинен бути не довший ніж 50 символів"; return; }
			
			if ($url && !filter_var($url, FILTER_VALIDATE_URL)) { $_SESSION["errors"]["add"] = "Введений URL не коректний"; return; }
			
			if (empty($text)) { $_SESSION["errors"]["add"] = "Введіть текст повідомленняі"; return; }
			if (iconv_strlen($text, "UTF-8") < 10 || iconv_strlen($text, "UTF-8") > 500) { $_SESSION["errors"]["add"] = "Текст повинен містити від 10 до 500 символів"; return; }

			if ($captcha != $_SESSION["captcha"]) { $_SESSION["errors"]["add"] = "Ви ввели не вірну CAPTCHA"; return; }
			
			if (empty($_SESSION["errors"]["add"]))
			{
				$model->addPost(array("name" => $name, "email" => $email, "url" => $url, "text" => $text));
				
				$_SESSION["success"]["add"] = "Повідомлення успішно відправлене";
				
				unset($_SESSION["lastPost"]);
			}
		}
	}
?>