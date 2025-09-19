<?php
/**
* index.php
*
* standalone receiver
* freestanding code to load the FrontController
* requires the "config.inc.php"
*/
//Debug
//$_SERVER["REMOTE_USER"] = $_SERVER['PHP_AUTH_USER'];
require_once "config/config.inc.php";
require_once "ASAP.class.php";
require_once "Web/FrontController.class.php";

// run the Front Controller
if(array_key_exists("REMOTE_USER",$_SERVER))
	if($_SERVER["REMOTE_USER"])
		$_REQUEST["action"] = "FePrCmdLogin";

FrontController::execute();
?>