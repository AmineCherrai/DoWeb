<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Filenotfound_Controller
{
	public function Index()
	{
		Doweb::view()->setVars('title', '404 NOT FOUND');
		Doweb::view()->setTemplate('notfound');
	}
}

#EOF