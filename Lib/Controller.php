<?php


class Controller extends  DBase  {
	

	private $views_dir = "Views".DS;
    protected  $db;



    // this will create connection with the database
    // store the connect pdo object in the db protected var
    protected function  create_db_connection(){
        $this->db = new DBase();
    }






	protected function json($json_string = null){
		
		if($json_string==null)
			return null;

		echo  json_encode($json_string);
	}


	protected function getParams($method = "*"){

		if($method=="self"){
			$method = $_SERVER['REQUEST_METHOD'];
		}



		if($method=="*") {
			return $_REQUEST;		
		}else if($method=="POST"){
			return $_POST;
		}else if($method=="GET"){
			return $_GET;
		}else if($method=="PUT"){
			return $_PUT;
		}else if($method=="DELETE"){
			return $_DELETE;
		}


		return null;
	}


	protected function getParam($key  , $method = "*"){
		if($method=="self"){
			$method = $_SERVER['REQUEST_METHOD'];
		}

		if($method=="*") {
			return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null ;		
		}else if($method=="POST"){
			return isset($_POST[$key]) ? $_POST[$key] : null ;
		}else if($method=="GET"){
			return isset($_GET[$key]) ? $_GET[$key] : null ;

		}else if($method=="PUT"){
			return isset($_PUT[$key]) ? $_PUT[$key] : null ;

		}else if($method=="DELETE"){
			return isset($_DELETE[$key]) ? $_DELETE[$key] : null ;

		}


		return null;
	}


}


