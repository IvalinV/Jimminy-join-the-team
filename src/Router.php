<?php
namespace App;

class Router
{
	private static $instance = null;

	private array $routes = [];

	public function __construct() {}

	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new self;
		}
 
    	return self::$instance;
	}

	public function addRoute($method, $url, $cb)
	{
		$this->routes[$method][$url] = $cb;
	}

	public function execute()
	{
		return call_user_func($this->routes[$_SERVER['REQUEST_METHOD']][$_SERVER['REQUEST_URI']]);
	}
}