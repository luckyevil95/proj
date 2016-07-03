<?php
	class AddPostView
	{
		public function AddPostView()
		{
			echo "
				<form method='post' class='addPostForm'>
					<div class='addPostFormTitle'>Додати повідомлення</div>
					<input name='name' type='text' class='addPostFormInput' placeholder='Ім&#39я' value='" . $_SESSION["lastPost"]["name"] . "'>
					<input name='email' type='text' class='addPostFormInput' placeholder='Email' value='" . $_SESSION["lastPost"]["email"] . "'>
					<input name='url' type='text' class='addPostFormInput' placeholder='URL сайту з протоколом (не обов&#39язково)' value='" . $_SESSION["lastPost"]["url"] . "'>
					<textarea name='text' class='addPostFormText' placeholder='Текст повідомлення'>" . $_SESSION["lastPost"]["text"] . "</textarea> 
					<img class='addPostFormCaptcha' src='/captcha.php'>
					<input name='captcha' type='text' class='addPostFormInput' placeholder='Введіть символи з картинки'>
					<input type='submit' class='addPostFormSubmit' value='Відправити'>
					<div class='addPostFormError'>" . $_SESSION["errors"]["add"] . "</div>
					<div class='addPostFormSuccess'>" . $_SESSION["success"]["add"] . "</div>
				</form>
			";
		}
	}
?>