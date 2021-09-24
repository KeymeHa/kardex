<?php

class Conexion
{
	static public function conectar()
	{
		$link = new PDO("mysql:host=localhost;dbname=kardex","root","");
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