<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Index_Controller
{
	public function Index()
	{
		Doweb::view()->setVars('title', 'Doweb');

		// get data from database
		$message_arr = Doweb::model('Thisismodel/Thisismethod');
		$message = $message_arr[1]['column_value'];

		// clean
		$message = Doweb::helper('input/clean', array($message, 'xss'));

		// set variable and pass it to the view/template
		Doweb::view()->setVars('message', $message);

		Doweb::view()->setTemplate('index');
	}
}

#EOF