<?php

/**
* JsrsHandler.php
*
* remote scripting request handler
* requires the "config.inc.php"
*/

require_once "../config/config.inc.php";
require_once "ASAP.class.php";
require_once "Application.class.php";
require_once "Data/Serializer.class.php";
require_once "jsrsServer.php.inc";

class jsrsHandler {
	
	var $service_name;
	var $class_name;
	var $file_name;
	var $methods;
	
	function processRequest() {

		global $_SERVER;

		$url = explode('?', basename($_SERVER['REQUEST_URI']));
		$this->service_name = $url[0];
		
		$current_script = basename($_SERVER['REDIRECT_URL']);

		if ($this->service_name == $current_script) {
			die ("internal error");
		}

		$this->class_name = $this->service_name . ".class.php";
		$this->file_name = "domain/" . $this->class_name;

		$config = Serializer::load(Application::getBaseDirectory()."/config/service.conf.data");
		$this->methods = $config["jsrs"]["services"][$this->service_name]; 

		require $this->file_name;
	}
	
	function run() {

		jsrsDispatch($this->methods);

	}
	
}

	$handler = new jsrsHandler();
	$handler->processRequest();

	$handler->run();
?>