<?php 

	class Router
	{
		private $routes;

		public function __construct()
		{

			$routesPath = ROOT.'/config/routes.php';
			$this->routes = include($routesPath);
		}
		
		private function getURI(){
			if (!empty($_SERVER['REQUEST_URI'])) {
				return trim($_SERVER['REQUEST_URI'],'/');
				// substr($_SERVER['REQUEST_URI'], strlen('/локальный адрес сайта/'));﻿
			}			
		}

		public function run(){
			$uri = $this->getURI();

			foreach ($this->routes as $uriPattern => $path) {
				if(preg_match("~$uriPattern~", $uri)){
/*------------------------------------------------------------------------------*/
				//Получаем внутренний путь из внешнего согласно правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
/*------------------------------------------------------------------------------*/				
				//Определить контроллер, action, параметры
				$segments = explode('/', $internalRoute);

				$controllerName =  array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);

				$actionName = 'action'.ucfirst(array_shift($segments));

				// echo "<br>conttroller name:$controllerName";
				// echo "<br>action name:$actionName";

				$parameters = $segments;
/*------------------------------------------------------------------------------*/
				//Определить контроллер, action, параметры

				$controllerFile = ROOT . '/controllers/'.
                $controllerName . '.php';

				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}
/*------------------------------------------------------------------------------*/
				//Создать обьект, вызвать метод (т.е action)
				$contollerObject = new $controllerName;

				$result = call_user_func_array(array($contollerObject,$actionName), $parameters);
				// $result = $contollerObject->$actionName($parameters);

				if ($result != null) {
					break;
				}
/*------------------------------------------------------------------------------*/
				}
			}
		}
	}


?>