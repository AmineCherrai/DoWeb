<?php

if(!defined('ROOT'))exit('No direct script access allowed');

class Db
{
	private $connection = null;
	
	public function __construct()
	{
		$this->config = Doweb::getConfig();
		$this->getConnection();
	}
	
	public function __destruct()
	{
		unset($this->config);
	}
	
	public function query($sqlQuery, $fetch = false)
	{
		$this->sth = $this->getConnection()->prepare($sqlQuery);
		$this->sth->execute();
		return ($fetch)?$this->fetch():true;
	}
	
	private function fetch($sth = null)
	{
		if(!is_null($sth))$this->sth=$sth;
		$fields = array();
		$data = array();
		$d=1;
		$numfields = $this->sth->columnCount();
	
		for ($i = 0; $i < $numfields; ++$i)
		{
			$filedName = $this->sth->getColumnMeta($i);
			array_push($fields,$filedName);
		}
	
		while($row=$this->sth->fetch())
		{
			for ($i = 0; $i < $numfields; ++$i)
			{
				if(!$this->mQuotes)$row[$i] = stripslashes($row[$i]);
				$data[$d][$fields[$i]['name']] = $row[$i];
			}
			++$d;
		}
		return $data;
	}
	
	public function rowsCount()
	{
		return $this->sth->rowCount();
	}
	
	public function InsertedId()
	{
		return $this->getConnection()->lastInsertId();
	}
	
	private function getConnection()
	{
		if(is_null($this->connection))
		{
			$host = $this->config['db_host'];
			$dbname = $this->config['db_name'];
			$db_driver = $this->config['db_driver'];
			$db_user = $this->config['db_user'];
			$db_password = $this->config['db_password'];
				
			try
			{
				$this->connection = new PDO("$db_driver:host=$host;dbname=$dbname", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				($this->config['environment'])?
					$this->connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING)
					:$this->connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
				$this->mQuotes = get_magic_quotes_gpc();
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		return $this->connection;
	}
}

#EOF