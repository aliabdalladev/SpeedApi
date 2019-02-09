<?php

$port               = $_SERVER['SERVER_PORT'];
$user_ip            = $_SERVER['SERVER_ADDR'];
$user_browser       = $_SERVER['HTTP_USER_AGENT'];
$user_remote_port   = $_SERVER['REMOTE_PORT'];
$request_uri        = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


// the main contoller name
$home_controller = "index";


$is_home_route = true;
// access to the url parmeters
// route = anything after the project dir like $(/home); route will be home 
// if there is no anything route will take index value witch should be the index page

$sub_route = null;

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

//var_dump($_SERVER);
$urks = explode("/",$uri);
echo json_encode($_SERVER);
exit();
if(strlen($uri)>20){
	$route = $uri;
}else{
	$route = $home_controller;
}



// if this is not this main route try to handle the request 
if($route!=$home_controller){

	// fetch all route links 
	// example /home/users/20
	// this will return array of = ['home','users','20']
	$routes_array = explode(DS,$route);


	// choose the first elements 
	// check if is not empty	
	if($routes_array[$startup_endpoint]){

		// overrides the route variable with the first element in the paramters arra
		$route = $routes_array[$startup_endpoint];

		if($routes_array[$startup_endpoint + 1]){
			$sub_route = $routes_array[$startup_endpoint + 1];
		}
		$is_home_route = false;	
	}else{

	
		showError("003","internal error try to route again");

	}
}





// check if the current route are registerd in routes array or not
// you can find routes array inside route.php file
if(array_key_exists($route,$routes)){



	// check if the current request method are allowed for this route or not
	if(in_array($_SERVER['REQUEST_METHOD'],$routes[$route])){



		if($sub_route!=null){
			if(array_key_exists($sub_route,$routes_sub_routes[$route])){

				if(in_array($_SERVER['REQUEST_METHOD'],$routes_sub_routes[$route][$sub_route])){


//

					$class	= ucwords($route);
					var_dump($routes_sub_routes[$route][$sub_route]);
//					if(class_exists($class)){
//
//						$object = new $class;
//
//						if(isset($routes_array[$startup_endpoint + 1]) && !empty($routes_array[$startup_endpoint + 1])){
//							$method = $routes_array[$startup_endpoint + 1];
//							if(method_exists($class,$method)){
//								$object->$method();
//							}else{
//								// internal error throw here
//								echo "no ({$method}) method inisde{$route}";
//							}
//
//						}else{
//							if(method_exists($class,'run')){
//								$object->run();
//							}else{
//								// internal error throw here
//								showError("003","internal error try to route again");
//							}
//						}
//
//
//					}else{
//
//					}




				}else
				{
					printError("600","{$_SERVER['REQUEST_METHOD']} request not allowed for this route {$route}");
					
				}


			}else{



			}



		}else{




			// check if the current route has class with it camcal case name or not
			// the script will try to include the route class file automatically inisde the spl_autoload_register  funtion
			$class	= ucwords($route);
			if(class_exists($class)){

				$object = new $class;

				if(isset($routes_array[$startup_endpoint + 1]) && !empty($routes_array[$startup_endpoint + 1])){
					$method = $routes_array[$startup_endpoint + 1];
					if(method_exists($class,$method)){
						$object->$method();
					}else{
						// internal error throw here
						echo "no ({$method}) method inisde{$route}";
					}

				}else{
					if(method_exists($class,'run')){
						$object->run();
					}else{
						// internal error throw here
						showError("003","internal error try to route again");
					}
				}


			}else{

			}


		}


	}else{
		printError("601","{$_SERVER['REQUEST_METHOD']} request not allowed for this route {$route}");

	}
	
}else{
	showError();
}


    exit();
?>