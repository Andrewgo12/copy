<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdDeleteAnexosAT {

	function execute() {

		extract($_REQUEST);
		settype($rcFileName, "array");
		settype($rcNew, "array");
		settype($rcTmp, "array");
		settype($nuCont, "integer");
		settype($nuRow, "integer");

		//se almacena el $_REQUEST para el control de campos dinamicos
		WebSession :: setProperty("rcRequest", $_REQUEST);

		//se obtienen los archivos ya guardados
		$rcFileName = WebSession :: getProperty("_rcFileList");

		if ($rcFileName && $deleteattachment) {
			$nuRow = 0;
			// se elimina el arcivo
			foreach ($rcFileName as $nuCont => $rcTmp) {

				if ($rcTmp["index"] == $deleteattachment) {
					WebSession :: unsetProperty($rcTmp["index"]);
				}else{
					$rcNew[$nuRow] = $rcTmp;
					$nuRow ++;
				}
			}
		}
		
		WebSession :: setProperty("_rcFileList", $rcNew);

		unset ($_REQUEST["deleteattachment"]);
		$_REQUEST["focusposition"] = "anexo";
		return "success";
	}
}
?>