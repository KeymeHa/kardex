<?php

class Conexion
{
	private $database = "edubarco_kardex";
	#private $userDB = "edubarco_admin";
	#private $passDB = "Casio$13bT";
	private $userDB = "root";
	private $passDB = "1994";
	
	public function getDatabase(){
		return $this->database;
	}

	public function getUserDB(){
		return $this->userDB;
	}

	public function getPassDB(){
		return $this->passDB;
	}

	static public function conectar()
	{
		$credc = new Conexion;//credenciales

		$link = new PDO("mysql:host=localhost;dbname=".$credc->getDatabase(),$credc->getUserDB(),$credc->getPassDB());
		$link->exec("set names utf8");

		if ($link->errorInfo()) 
		{
			$file = fopen("error_log.txt", "w");
			fwrite($file, $link->errorCode() . PHP_EOL);
			#fwrite($file, "Otra más" . PHP_EOL);
			fclose($file);
		}

		return $link;
	}
	 
}



