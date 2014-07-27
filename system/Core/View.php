<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class View
{
	private $template = null,
			$config = array();
	public $vars = array();
	
	public function __construct()
	{
		$this->config = Doweb::getConfig();
		
		$this->setVars('css_path', $this->config['css_path']);
		$this->setVars('js_path', $this->config['js_path']);
		$this->setVars('jq_path', $this->config['jq_path']);
		$this->setVars('img_path', $this->config['img_path']);
		$this->setVars('website', $this->config['website']);
		$this->setVars('domain', $this->config['domain']);
	}
	
	public function __destruct()
	{
		unset($this->config);
	}
	
	public function setTemplate($template)
	{
		$this->template = $this->config['views_path'].$template.$this->config['views_ext'];
		if(file_exists($this->template) == false)
		{
			exit('Template not found in '. $template);
		}
	}
	
	function showTemplate()
	{
		if($this->template)
		{
			foreach ($this->vars as $key => $value)
			{
				$$key = $value;
			}
			
			ob_start();
			include($this->template);
			$this->template = ob_get_contents();
			ob_end_clean();
			echo $this->template;
		}
	}
	
	public function setVars($index, $value)
	{
		$this->vars[$index] = $value;
	}
}

#EOF