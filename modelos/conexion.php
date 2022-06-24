<?php

class Conexion
{
	private $database = "kardex";
	private $userDB = "root";
	private $passDB = "";
	
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

		return $link;
	}

	static public function conectarRead()
	{
		$link = new PDO("mysql:host=localhost;dbname=kardex","OnlyRead","lectura");
		$link->exec("set names utf8");

		return $link;
	}


	 
}



