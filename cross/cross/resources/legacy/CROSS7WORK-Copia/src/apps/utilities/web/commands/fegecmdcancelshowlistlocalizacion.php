<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdCancelShowListLocalizacion {

	function execute() {

		$_REQUEST["localizacion__locacodigos"] = WebSession :: getProperty("localizacion__locacodigos");
		$_REQUEST["localizacion__locanombres"] = WebSession :: getProperty("localizacion__locanombres");
		$_REQUEST["localizacion__locadescrips"] = WebSession :: getProperty("localizacion__locadescrips");
		$_REQUEST["localizacion__tilocodigos"] = WebSession :: getProperty("localizacion__tilocodigos");
		if(WebSession :: getProperty("localizacion__locacodpadrs")){
			$_REQUEST["localizacion__locacodpadrs"] = WebSession :: getProperty("localizacion__locacodpadrs");
		}else{
			$_REQUEST["localizacion__locacodpadrs"] = null;
		}
		$_REQUEST["localizacion__locaordenn"] = WebSession :: getProperty("localizacion__locaordenn");
		$_REQUEST["localizacion__locazonas"] = WebSession :: getProperty("localizacion__locazonas");
		$_REQUEST["localizacion__locaestados"] = WebSession :: getProperty("localizacion__locaestados");

		WebSession :: unsetProperty("localizacion__locacodigos");
		WebSession :: unsetProperty("localizacion__locanombres");
		WebSession :: unsetProperty("localizacion__locadescrips");
		WebSession :: unsetProperty("localizacion__tilocodigos");
		WebSession :: unsetProperty("localizacion__locacodpadrs");
		WebSession :: unsetProperty("localizacion__locaordenn");
		WebSession :: unsetProperty("localizacion__locazonas");
		WebSession :: unsetProperty("localizacion__locaestados");

		return "success";
	}
}
?>