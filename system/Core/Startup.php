<?php

if(!defined('ROOT'))exit('No direct script access allowed');

/** include common file */
require(realpath(CORE_PATH.'Doweb'.EXT));
$Doweb = Doweb::getInstance();

/** load THE ROUTER class and parse the url */
Doweb::load(CORE_PATH , 'Router');
$Router = new Router();

/** load the Controller */
$ctrlClass = $Router->controller.Doweb::getConfig('controller_path_suffix');
if(class_exists($ctrlClass) || Doweb::load(Doweb::getConfig('controllers_path'), $ctrlClass))
{
	if (is_callable(array($ctrlClass, $Router->action)) == true)
	{
		$ctrInst = new $ctrlClass();
		call_user_func_array(array($ctrInst , $Router->action), $Router->attr);
		Doweb::View()->showTemplate();
	}
	else
	{
		Doweb::show404();
	}
}
else
{
	Doweb::show404();
}

#EOF