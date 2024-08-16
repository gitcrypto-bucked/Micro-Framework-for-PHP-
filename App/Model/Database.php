<?php

namespace App\Model;

use \Cfg\Config;
use PDO;

class Database
{

    function connect()
	{
		 $db = null;

		if ($db === null) 
		{
			if(Config::DATABASE_DRIVER=='mysql')
			{
				$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
				try 
				{
					$db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
				} 
				catch (\PDOException $e) 
				{
					throw new \Exception($e->getMessage(), $e->getCode());
					exit;
				}
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $db;
			}
		}

		
	}
}
?>