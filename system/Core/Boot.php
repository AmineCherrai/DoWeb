<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Boot
{
	private $config = array();
	
	function __construct()
	{
		$this->setConfig();
		$this->setReporting();
	}
	
	function __destruct()
	{
		unset($this->config);
	}
	
	private function setReporting()
	{
		error_reporting(E_ALL);
		if ($this->config['environment'] == true)
		{
			ini_set('display_errors','On');
		}
		else
		{
			ini_set('display_errors','Off');
			ini_set('log_errors', 'On');
			ini_set('error_log', $this->config['log_file']);
		}
	}
	
	private function setConfig()
	{
		/** include USER configuration file */
		$config_user = realpath(APPLICATION . 'Configuration' . DS . 'config.php');
		if(!file_exists($config_user))exit('configuration file is not found');
		include($config_user);
		if(!isset($config) OR !is_array($config))exit('configuration is not formated correctly');
		$this->config = $config;
		unset($config);
		
		/** include ROUTER configuration file */
		$config_router = realpath(APPLICATION . 'Configuration' . DS . 'router.php');
		if(!file_exists($config_router))exit('Router configuration file is not found');
		include($config_router);
		if( !isset($config) OR !is_array($config) )exit('Router configuration is not formated correctly');
		$this->config += $config;
		unset($config);
		
		/** include DB configuration file */
		$config_db = realpath(APPLICATION . 'Configuration' . DS . 'database.php');
		if(!file_exists($config_db))exit('Database configuration file is not found');
		include($config_db);
		if( !isset($config) OR !is_array($config) )exit('Database configuration is not formated correctly');
		$this->config += $config;
		unset($config);
	}
	
	public function getConfig()
	{
		return $this->config;
	}
}

#EOF