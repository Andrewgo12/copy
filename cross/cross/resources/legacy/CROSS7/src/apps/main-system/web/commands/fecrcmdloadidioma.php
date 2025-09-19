<?php
class FeCrCmdLoadIdioma {
	function execute() {
		
		if(is_array($_REQUEST))
			extract($_REQUEST);
		if(is_array($params))
			extract($params);
		
		$authSess = Application::getUserParam();
		$authSess["lang"] = $lang;
		$_SESSION["_authsession"] = $authSess;
		
		die();
	}
}
?>