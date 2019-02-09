<?php
// start output bufering
ob_start();


// include the main settings like DS
// DS = DIRECTORY_SEPARATOR
// DIR
// FILE
require_once("config.php");



// all routes should be registered in this file
// also you should specifty the allowed request method for evey route
require_once("route.php");


// include all needed class like database
// the database is one of the resource that you can get 
// go to resources dir and check what you can use 
UseResource("DBase");

// include the main controller class
// whitch contain view method and json 
// you will need to make any one of your controller to extends this class

UseLibarary("Controller");




require_once("url.php");




ob_end_flush();
?>
