<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdDeleteAnexosSol {

	function execute() {

		extract($_REQUEST);
		settype($rcFileName, "array");
		settype($rcNew, "array");
		settype($rcTmp, "array");
		settype($nuCont, "integer");
		settype($nuRow, "integer");

		//se obtienen los archivos ya guardados
		$rcFileName = WebSession :: getProperty("_rcSolucionFileList");

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
		
		WebSession :: setProperty("_rcSolucionFileList", $rcNew);

		unset ($_REQUEST["deleteattachment"]);
		$_REQUEST["focusposition"] = "anexos___anexnombarch";
		return "success";
	}
}
?>