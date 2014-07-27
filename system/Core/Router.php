<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Router
{
	private $config = array();
	public $controller,
		   $action,
		   $attr = array();
	
	function __construct()
	{
		$this->config = Doweb::getConfig();
		$this->url = (!isset($_GET['url']) OR empty($_GET['url'])) ? null : $_GET['url'];
		$this->parseURL();
		unset($this->url, $this->config);
	}
	
	private function parseURL()
	{
		$urlArray = array();
	
		$this->url = trim($this->url, '/\\');
		$urlArray = explode("/",$this->url);
		
		if(!empty($urlArray[0]))
		{
			$this->controller = $urlArray[0];
		}
		else
		{
			$this->controller = $this->config['default_controller'];
		}
		$this->controller = ucfirst(strtolower($this->controller));
		
		array_shift($urlArray);
		if(!empty($urlArray[0]))
		{
			$this->action = $urlArray[0];
		}
		else
		{
			$this->action = $this->config['default_action'];
		}
		$this->action = ucfirst(strtolower($this->action));
		
		array_shift($urlArray);
		$this->attr = $urlArray;
		
	}

}

#EOF