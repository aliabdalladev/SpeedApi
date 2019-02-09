<?php
class Encryption {


	private $session_private_key = null; 	

	private $drivers = [
		"file" => ["path" => "session/privates_key/"],
		"session" => ["key" => "session_private_key"],
		"db" => ["table" => "session","conn" => null]	
	]; 

	private $driver = "session";




	public static function getPrivateKey(){

		
		$pk = self::generatePK();
		return $pk;

		
	}




	public static function generatePK() {
		
		
		$pk = time();
			
		return $pk;
		
	}



}
