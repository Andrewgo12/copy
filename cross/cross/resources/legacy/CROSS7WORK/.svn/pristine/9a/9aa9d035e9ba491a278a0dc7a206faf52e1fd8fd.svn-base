<?php  
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdUpdateOrganizacion {
	function execute() {
		
		settype($serviceDate,"object");
		settype($sbmessage,"string");
		extract($_REQUEST);
		
		if (($organizacion__orgacodigos != NULL) && ($organizacion__orgacodigos != "")
		&& ($organizacion__organombres != NULL) && ($organizacion__organombres != "")
		&& ($organizacion__tiorcodigos != NULL) && ($organizacion__tiorcodigos != "")
		&& ($organizacion__esorcodigos != NULL) && ($organizacion__esorcodigos != "")
		&& ($organizacion__grupcodigos != NULL) && ($organizacion__grupcodigos != "")) {
			
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($organizacion__orgacodigos) == false) {
				WebRequest :: setProperty('cod_message', $sbmessage = 4);
				return "fail";
			}
			
			//Hace la validacion de campos numericos y formateo de campos cadena
			$organizacion__organombres = $objServ->formatString($organizacion__organombres);
			$organizacion__tiorcodigos = $objServ->formatString($organizacion__tiorcodigos);
			$organizacion__orgacgpads = $objServ->formatString($organizacion__orgacgpads);
			
			if ($organizacion__orgaordenn == "") {
				$organizacion__orgaordenn = "NULL";
			}
			
			if ($objServ->isInteger($organizacion__orgaordenn) == false) {
				WebRequest :: setProperty('cod_message', $sbmessage = 4);
				return "fail";
			}
			
			if ($organizacion__orgafechcred == "") {
				$organizacion__orgafechcred = "NULL";
			}else{
				//Servicio  de manipulacion de fechas
				$serviceDate = Application :: loadServices("DateController");
				if ($serviceDate->fncvalidatedate($organizacion__orgafechcred)) {
				$organizacion__orgafechcred = $serviceDate->fncdatehourtoint($organizacion__orgafechcred);
				} else {
					WebRequest :: setProperty('cod_message', $sbmessage = 7);
					return "fail";
				}
			}
			
			$organizacion__esorcodigos = $objServ->formatString($organizacion__esorcodigos);
			$organizacion__grupcodigos = $objServ->formatString($organizacion__grupcodigos);
			$organizacion__orgatelefo1s = $objServ->formatString($organizacion__orgatelefo1s);
			$organizacion__orgatelefo2s = $objServ->formatString($organizacion__orgatelefo2s);
			$organizacion__locacodigos = $objServ->formatString($organizacion__locacodigos);
			
			$organizacion_manager = Application :: getDomainController('OrganizacionManager');
			
			$sbmessage = $organizacion_manager->updateOrganizacion($organizacion__orgacodigos, $organizacion__organombres, $organizacion__tiorcodigos, 
			$organizacion__orgacgpads, $organizacion__orgaordenn, $organizacion__orgafechcred, $organizacion__esorcodigos, $organizacion__grupcodigos, $organizacion__orgatelefo1s, $organizacion__orgatelefo2s, $organizacion__locacodigos);
			
			WebRequest :: setProperty('cod_message', $sbmessage);
			if($sbmessage == 3)
				return "success";
			else
				return "fail";
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 0);
			return "fail";
		}
	}
}
?>