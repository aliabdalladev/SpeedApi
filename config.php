<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('IsPublic:' . true);

define("DS",DIRECTORY_SEPARATOR);
define("DIR",__DIR__);
define("FILE",__FILE__);



// start folder for the project
$startup_endpoint = 3;


function env($env_name){
	$env_data = null;
	exec("cat .env"." | grep ". $env_name, $env_data) ;
	if(count($env_data)>=1){
		$item = explode("=",$env_data[0]);
		return end($item);
			
	}else{
		return "";	
	}
}


function UseLibarary($lib = ""){
	$path = __DIR__.DS."Lib".DS.$lib.".php";
	if(env("APP_DEBUG")===TRUE){ 
		require_once($path);
	}else{
		if(is_file($path)){
			require_once($path);
		}else{
			printError("404","an't include libarary : " . $lib);

		}
	}
	
}


function UseResource($resource = ""){
	$path = __DIR__.DS."Recources".DS.$resource.".php";
	if(env("APP_DEBUG")===TRUE){ 
		require_once($path);
	}else{
		if(is_file($path)){
			require_once($path);
		}else{
			printError("404","an't include Recource : " . $lib);

		}
	}
	
}


function printError($code = "404",$message="not found"){

	echo json_encode(["error"=>$code,"message"=>$message]);
	exit();		
	
	
}






// autoload any class that is never founded the paga
spl_autoload_register(function ($class_name) {
	// convert the class name to be camel case name end with Controller keywords
	// example index => IndexController
   	$class_name = ucwords($class_name."Controller"); 
	
	// make the included file path	
	$path = "Controllers".DS.$class_name.".php";
	// if is exists 	
	if(is_file($path)){

		// include the file
		require_once($path);
		
	}else{


		// include the error page 
		echo "error";
	}
	
});