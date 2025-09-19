<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDeleteActaempresa {
	function execute() {
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($nuMessage,"integer");
		
		if (($orden != NULL) && ($orden != "") 
		&& ($acta != NULL) && ($acta != "")
		&& ($acemnumeros != NULL) && ($acemnumeros != "")) {
			
			$objManager = Application :: getDomainController('ActaempresaManager');

			$rcCompromisosAtendidos = $objManager->getCompromisosAtendidosByActa($acemnumeros);
			if(is_array($rcCompromisosAtendidos)) {
				WebRequest :: setProperty('cod_message', $nuMessage = 65);
				return "fail";
			}
			$nuMessage = $objManager->deleteActaempresa($orden, $acta, $acemnumeros);
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>