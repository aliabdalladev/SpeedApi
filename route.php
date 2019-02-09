<?php
/*
	you must sign your route here 
	with the access method for it like 
	home => ['GET']
	that mean only get request can access to the home route
*/
$routes = 
[
	"index" => ["GET"],
	"home"=>["GET"]
];




// the main route should be registered in the routes  array
// keep remmeber that everything will  be handled before we call it
$routes_sub_routes = [
	'home' => [
		"users" => ['GET','POST']
	]
]



?>
