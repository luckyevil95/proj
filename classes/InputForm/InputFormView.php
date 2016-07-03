<?php
	class InputFormView
	{
		public function InputFormView()
		{
			echo "
				<form method='post' class='addPostForm'>
					<div class='addPostFormTitle'>Вхід для модератора</div>
					<input name='login' type='text' class='addPostFormInput' placeholder='Логін' value='" . $_SESSION["lastInput"]["login"] . "'>
					<input name='password' type='password' class='addPostFormInput' placeholder='Пароль'>
					<input type='submit' class='addPostFormSubmit' value='Увійти'>
					<div class='addPostFormError'>" . $_SESSION["errors"]["input"] . "</div>
				</form>
			";
		}
	}
?>