<?php require_once "./classes/InputForm/InputFormModel.php"; ?>
<?php require_once "./classes/InputForm/InputFormController.php"; ?>
<?php require_once "./classes/InputForm/InputFormView.php"; ?>

<?php require_once "/header.php"; ?>

<?php
	$inputFormModel = new InputFormModel();
	$inputFormController = new InputFormController($inputFormModel);
	$inputFormView = new InputFormView();
?>

<?php require_once "/footer.php"; ?>