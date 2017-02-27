<?php 

	class Router
	{
		private $routes;

		public function __construct()
		{
			$routesPath = '../config/routes.php';
			$this->routes = include($routesPath);
		}

		public function run(){
			// print_r($this->routes);
			echo "Class Router, method run";
		}
	}


?>