<?php

require_once('vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTclass
{
	static public function jwt($id, $usuario)
	{
		$actual = time();

		$token = array('iat' => $actual, 
						'exp' => ($actual*60),
						'data' => 
						[
							"id" => $id,
							"usr" => $usuario 
						]);

		$key = '17t5t0tyazyZ8JXwAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H';

		$jwt = JWT::encode($token, $key, 'HS256');
		//$decoded = JWT::decode($jwt, new Key($key, 'HS256'));

		return $jwt;
	}
}