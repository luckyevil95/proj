<?php
	class LoadCountPosts
	{
		private $CONNECT;
		private $countPosts;
		
		function LoadCountPosts()
		{
			global $CONNECT;
			
			$this->CONNECT = $CONNECT;
			
			$this->getCountPosts();
		}
		
		private function getCountPosts()
		{
			$query = mysqli_fetch_assoc(mysqli_query($this->CONNECT, "SELECT COUNT(*) FROM `posts`"));
			
			$this->countPosts = $query["COUNT(*)"];
		}
		
		public function returnResponse()
		{
			return $this->countPosts;
		}
	}
?>