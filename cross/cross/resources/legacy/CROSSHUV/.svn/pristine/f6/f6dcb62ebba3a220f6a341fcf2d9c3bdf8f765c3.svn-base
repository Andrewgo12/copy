<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeEnCmdCancelShowListFormulario {
	function execute(){
		$_REQUEST["formulario__formcodigon"] = WebSession::getProperty("formulario__formcodigon");
		$_REQUEST["formulario__formnombres"] = WebSession::getProperty("formulario__formnombres");
		$_REQUEST["formulario__formfeccrean"] = WebSession::getProperty("formulario__formfeccrean");
		$_REQUEST["formulario__formintrodus"] = WebSession::getProperty("formulario__formintrodus");
		$_REQUEST["formulario__formpredets"] = WebSession::getProperty("formulario__formpredets");
		$_REQUEST["formulario__formactivos"] = WebSession::getProperty("formulario__formactivos");
		WebSession::unsetProperty("formulario__formcodigon");
		WebSession::unsetProperty("formulario__formnombres");
		WebSession::unsetProperty("formulario__formfeccrean");
		WebSession::unsetProperty("formulario__formintrodus");
		WebSession::unsetProperty("formulario__formpredets");
		WebSession::unsetProperty("formulario__formactivos");
		return "success";
	}
}
?>