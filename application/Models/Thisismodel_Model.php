<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Thisismodel_Model
{
	public function Thisismethod()
	{	
		$sqlQuery = "SELECT * FROM `table` WHERE `column_id`=1";
		$result = Doweb::Db()->query($sqlQuery, true);
		return $result;
	}

}

#EOF