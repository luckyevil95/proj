<?php require_once "./classes/AddPostForm/AddPostModel.php"; ?>
<?php require_once "./classes/AddPostForm/AddPostController.php"; ?>
<?php require_once "./classes/AddPostForm/AddPostView.php"; ?>

<?php require_once "/header.php"; ?>

<?php
	$addPostModel = new AddPostModel();
	$addPostController = new AddPostController($addPostModel);
	$addPostView = new AddPostView();
?>

<?php require_once "/footer.php"; ?>