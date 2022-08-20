<?php

namespace App;

class Route
{
	private Router $router;

	public function __construct()
	{
		$this->router = Router::getInstance();
	}

	public function get($url, $cb)
	{
		$this->router->addRoute('GET', $url, $cb);
	}

	public function post($url, $cb)
	{
		$this->router->addRoute('POST', $url, $cb);
	}
}