<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowByIdLocalizacion {

	function execute() {
		extract($_REQUEST);

		if (($localizacion__locacodigos != NULL) && ($localizacion__locacodigos != "")) {
			$localizacion_manager = Application :: getDomainController('LocalizacionManager');
			$localizacion_data = $localizacion_manager->getByIdLocalizacion($localizacion__locacodigos);

			$_REQUEST["localizacion__locacodigos"] = $localizacion_data[0]["locacodigos"];
			$_REQUEST["localizacion__locanombres"] = $localizacion_data[0]["locanombres"];
			$_REQUEST["localizacion__locadescrips"] = $localizacion_data[0]["locadescrips"];
			$_REQUEST["localizacion__tilocodigos"] = $localizacion_data[0]["tilocodigos"];
			if($localizacion_data[0]["locacodpadrs"]){
				$_REQUEST["localizacion__locacodpadrs"] = $localizacion_data[0]["locacodpadrs"];
				$_REQUEST["is_null"] = false;
			}else{
				$_REQUEST["localizacion__locacodpadrs"] = "";
			}
			$_REQUEST["localizacion__locaordenn"] = $localizacion_data[0]["locaordenn"];
			$_REQUEST["localizacion__locazonas"] = $localizacion_data[0]["locazonas"];
			$_REQUEST["localizacion__locaestados"] = $localizacion_data[0]["locaestados"];

		} else {

			$_REQUEST["localizacion__locacodigos"] = WebSession :: getProperty("localizacion__locacodigos");
			$_REQUEST["localizacion__locanombres"] = WebSession :: getProperty("localizacion__locanombres");
			$_REQUEST["localizacion__locadescrips"] = WebSession :: getProperty("localizacion__locadescrips");
			$_REQUEST["localizacion__tilocodigos"] = WebSession :: getProperty("localizacion__tilocodigos");
			$_REQUEST["localizacion__locacodpadrs"] = WebSession :: getProperty("localizacion__locacodpadrs");
			$_REQUEST["localizacion__locaordenn"] = WebSession :: getProperty("localizacion__locaordenn");
			$_REQUEST["localizacion__locazonas"] = WebSession :: getProperty("localizacion__locazonas");
			$_REQUEST["localizacion__locaestados"] = WebSession :: getProperty("localizacion__locaestados");
		}

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