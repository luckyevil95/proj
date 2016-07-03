<?php
	class LoadPosts
	{
		private $CONNECT;
		private $posts;
		
		const COUNTPOSTSPAGE = 5;
		
		public function LoadPosts()
		{
			global $CONNECT;
			
			$this->CONNECT = $CONNECT;
			
			$this->getPosts();
		}
		
		private function getPosts()
		{
			$firstPost = $_POST["number"] * self::COUNTPOSTSPAGE - self::COUNTPOSTSPAGE;
			
			if ($_SESSION["isModerator"])
				$query = mysqli_query($this->CONNECT, "SELECT * FROM `posts` ORDER BY `" . $_POST["orderType"] . "` " . $_POST["orderDirection"] . " LIMIT " . $firstPost . ",5");
			else
				$query = mysqli_query($this->CONNECT, "SELECT `id`,`name`,`email`,`url`,`text`,`date` FROM `posts` ORDER BY `" . $_POST["orderType"] . "` " . $_POST["orderDirection"] . " LIMIT " . $firstPost . ",5");
			
			while ($row = mysqli_fetch_assoc($query))
			{
				$queryArray[] = $row;
			}
			
			$this->posts = $queryArray; 
		}
		
		public function returnResponse()
		{
			return json_encode($this->posts);
		}
	}
?>