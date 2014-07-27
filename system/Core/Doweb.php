<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Doweb
{
	private static $db = null,
				   $view = null,
				   $helper = null,
	        	   $objects = array(),
				   $config = array();
	private $Boot = null;
	
	public static $inst = null;

    public static function getInstance()
    {
        if(is_null(self::$inst))
        {
        	self::$inst = new Doweb();
        }
        
        return self::$inst;
    }
    
    private function __construct()
    {
    	/** include boot file and start booting... */
    	Doweb::load(CORE_PATH , 'Boot');
    	$this->BOOT = new Boot();
    	$this->setConfig();
    	
    	/** include View file... */
    	Doweb::load(CORE_PATH , 'View');
    	self::$view = new View();
    	
    	if(self::$config['use_db'])
    	{
	    	/** include DB file... */
	    	Doweb::load(CORE_PATH , 'Db');
	    	self::$db = new Db();
    	}
    }
    
    function __destruct()
    {
    	unset($this->BOOT);
    }
    
    private function setConfig()
    {
    	self::$config = $this->BOOT->getConfig();
    }
    
    public static function getConfig($key = null)
    {
    	if(is_null($key))
    	{
    		return self::$config;
    	}
    	else
    	{
    		if(!is_null($key) && key_exists($key, self::$config))
    		{
    			return self::$config[$key];
    		}
    		else
    		{
    			return false;
    		}
    	}
    }
    
    public static function Db()
    {
    	if(!self::$config['use_db'])
    		die('$config["use_db"] is false make it true if you are using Database');
    	return self::$db;
    }
    
    public static function view()
    {
    	return self::$view;
    }
    
    public static function helper($helper = null, $attr = array())
    {
    	if(is_null($helper))
    	{
    		return false;
    	}
    	else
    	{
    		$helperArr = explode('/', $helper);
    		$helperClass = ucfirst(strtolower($helperArr[0])).HELPER_CLASS_SUFFIX;
    		$helperAction = ucfirst(strtolower($helperArr[1]));
    		
    	
    		if(class_exists($helperClass) || Doweb::load(HELPERS_PATH, $helperClass))
    		{
    			if(is_callable(array($helperClass, $helperAction)) == true)
    			{
    				$helperInst = self::setObjects($helperClass);
    				$attr = (is_array($attr))?$attr:array($attr);
    				return call_user_func_array(array($helperInst , $helperAction),$attr);
    			}
    		}
    		return false;
    	}
    }
    
    public static function model($model = null, $attr = array())
    {
    	if(is_null($model))
    	{
    		return false;
    	}
    	else
    	{
    		$modelArr = explode('/', $model);
    		$modelClass = ucfirst(strtolower($modelArr[0])).self::getConfig('model_class_suffix');
    		$modelAction = ucfirst(strtolower($modelArr[1]));
    		
    		if(class_exists($modelClass) || Doweb::load(Doweb::getConfig('models_path'), $modelClass))
    		{
	    		if(is_callable(array($modelClass, $modelAction)) == true)
	    		{
	    			$modelInst = self::setObjects($modelClass);
	    			$attr = (is_array($attr))?$attr:array($attr);
	    			return call_user_func_array(array($modelInst , $modelAction),$attr);
	    		}
    		}
    		return false;
    	}
    }
    
    private static function setObjects($class)
    {
    	if(key_exists($class, self::$objects))
    	{
    		$classInst = self::$objects[$class];
    	}
    	else
    	{
    		$classInst = new $class();
    		self::$objects[$class] = $classInst;
    	}
    	
    	return $classInst;
    }
    
    public static function load($path, $className)
    {
    	$file = $path.$className.EXT;
    	if (file_exists($file))
    	{
    		include($file);
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
    
    public static function show404()
    {
    	$url404 = self::$config['website'].self::$config['default_fileNotFound'];
    	header('Location: '.$url404);
    	exit();
    }
}

#EOF