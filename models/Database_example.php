<?php

/**
 * Class to connect to the data base
 */
class Database
{

	const HOST = "localhost",
		  DBNAME = "", // Name of your database
		  LOGIN = "", // Your login
		  PWD = ""; // Your password

	static public function DB(){
		try
		{
			$db = new PDO("mysql:host=" . self::HOST .";dbname=" . self::DBNAME , self::LOGIN, self::PWD);
			return $db;
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

}
