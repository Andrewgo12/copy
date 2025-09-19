<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultActaempresa {
	function execute() {
		
		extract($_REQUEST);
		settype($rcFileName, "array");
		settype($rcTmp, "array");
		settype($rcNull, "array");
		settype($nuCont, "integer");
		
		//SI limpia el $_REQUEST
		if (($clean_table)) {
			$cargo_manager = Application :: getDomainController("ActaempresaManager");
			$cargo_manager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		
		//se obtienen los archivos ya guardados
		$rcFileName = WebSession :: getProperty("_rcFileList");
		
		if($rcFileName){
			foreach($rcFileName as $nuCont=>$rcTmp){
				WebSession :: unsetProperty($rcTmp["index"]);
			}
			WebSession :: setProperty("_rcFileList", $rcNull);
		}
		
		if(WebSession :: issetProperty("rcRequest")){
			WebSession :: unsetProperty("rcRequest");
		}
		
		//Limpia las actividades de la sesion
		WebSession :: unsetProperty("activiacta");
		return "success";
	}
}
?>