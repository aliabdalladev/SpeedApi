<?php
UseLibarary("LocalStorage");
UseLibarary("Encryption");


class Home extends Controller {
	

	private $upk = null;
	function __construct(){
		// constrcut function
		// will run at the same time this class is initz
		$this->upk =  Encryption::getPrivateKey();
	}

	function __destruct(){
		// __destruct function
		// use to kill unneeded proccess like db connection 

	
	}


	/*entiry point for processes 
	the app start here 
	we proccess every thing starting from here	
	*/
	public function run(){		
		/* this startup function for any controller */
		$params["user"] = $this->getParams();
		$params["pk"] = $this->upk;
        return $this->json($params);
		 
	}

	public function users(){
        $params = $this->getParams();
        
	}

	
}
