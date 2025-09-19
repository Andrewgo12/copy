<?php
require_once "Web/WebRequest.class.php";
require_once "Web/WebSession.class.php";
class FeScCmdLoadIdioma {
	function execute() {
		
		extract($_REQUEST);
		extract($params);
		
		$authSess = WebSession :: getProperty("_authsession");
		$authSess["lang"] = $lang;
		WebSession::setProperty("_authsession",$authSess);
		
		die ($_SESSION["_authsession"]["lang"]);
	}
}
?>