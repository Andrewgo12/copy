<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddIpsservicio {
	function execute() {
		
		settype($objService,"object");
		settype($nuMessage,"integer");
		extract($_REQUEST);
		if (($ipsservicio__ipsecodigos != NULL) && ($ipsservicio__ipsecodigos != "") 
		&& ($ipsservicio__ipsenombres != NULL) && ($ipsservicio__ipsenombres != "")) {
			$objService = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objService->formatPrimaryKey($ipsservicio__ipsecodigos) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}
			
			//Hace la validacion de campos numericos y formateo de campos cadena
			$ipsservicio__ipsenombres = $objService->formatString($ipsservicio__ipsenombres);
			$ipsservicio__ipsedescrips = $objService->formatString($ipsservicio__ipsedescrips);
			$ipsservicio_manager = Application :: getDomainController('IpsservicioManager');
			$nuMessage = $ipsservicio_manager->addIpsservicio($ipsservicio__ipsecodigos, 
			$ipsservicio__ipsenombres, $ipsservicio__ipsedescrips, $ipsservicio__ipseactivos);
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>