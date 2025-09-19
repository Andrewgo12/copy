<?php

/**
* jsrs.php
*
* remote scripting request broker
* requires the "config.inc.php"
*/

require_once "../config/config.inc.php";
require_once "ASAP.class.php";
require_once "Application.class.php";
require_once "Services/JsrsServer.class.php";

// require_once "Data/Serializer.class.php";

$invocation = $_REQUEST["F"];
list ($class, $method) = explode("::", $invocation);

if ($class != "DataGateway") {
	$obj = Application::getDomainController($class);
}

if ($class != "DataGateway" && PEAR::isError($obj)) {
	JsrsServer::sendErrorResponse("Class not found");	
} else {
	$preffix = Application :: getAppId();
	$invocation = $preffix.$invocation;
	$_REQUEST["F"] = $preffix.$_REQUEST["F"];
	JsrsServer::dispatch($invocation);
}

class DataGateway {
	
	function execute() {
		
		// must have a variable number of parameters
		$numargs = func_num_args();
		
		if ($numargs < 2) {
			return PEAR::raiseError("Wrong number of parameters");
		}  else {
						
			$args = func_get_args();
			
			// get the first parameter
			$table_name = array_shift($args);
			
			$obj = Application::getDataGateway($table_name);

			if (!PEAR::isError($obj)) {
				// get the second parameter
				$method_name = array_shift($args);
			
				// call the function
				$res = call_user_func_array(
					array(&$obj, $method_name),
					$args);
								
				return $res; 
				
			}
		}
	}
}


?>