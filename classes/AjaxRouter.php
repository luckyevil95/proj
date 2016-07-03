<?php
	$dir = "./classes/AjaxResponses";
	$dh  = opendir($dir);
	
	while ($filename = readdir($dh)) {
		if ($filename != "." && $filename != "..")
		{
			$filename = $dir . "/" . $filename;
			require_once $filename;
		}
	}
	
	closedir($dh);
	
	class AjaxRouter
	{
		public function AjaxRouter($type)
		{
			switch ($type)
			{
				case "loadPosts":
					$responseObject = new LoadPosts();
					break;
					
				case "loadCountPosts":
					$responseObject = new LoadCountPosts();
					break;
					
				case "deletePost":
					$responseObject = new DeletePost();
					break;
				case "editPost":
					$responseObject = new EditPost();
					break;
			}
			
			echo $responseObject->returnResponse();
		}
	}
?>