<?php

class DB{
	
	
	public static function getConnection(){
		
		$par = include(ROOT.'/config/DBParametrs.php');
		
		$db = new PDO ("mysql:host={$par['host']};
		dbname={$par['dbname']}", $par['user'], $par['password']);
		
		return $db;
	}
	
}
