<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Input_Helper
{
	public function clean($input, $action)
	{
		if(is_array($input))
		{
			foreach($input as $k => $v)
			{
				$input[$this->$action($k)] = $this->$action(urldecode($v));
			}
			return $input;
		}
		return $this->$action( urldecode($input));
	}
	
	private function xss($value)
	{
		$value = htmlspecialchars($value);
		return $value;
	}
	
	private function sqlinjection($value)
	{
		if(!get_magic_quotes_gpc())$value =addslashes($value);($value);
		return $value;
	}
}

#EOF