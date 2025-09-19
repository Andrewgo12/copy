<?php  
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdUpdateActaempresa {
	function execute() {
		
		extract($_REQUEST);
		settype($sbDbNull,"string");
		
		if (($actaempresa__actacodigos != NULL) && ($actaempresa__actacodigos != "") 
		&& ($actaempresa__acemnumeros != NULL) && ($actaempresa__acemnumeros != "")) {
			
			//constantes
			$sbDbNull = Application :: getConstant("DB_NULL");
			
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($actaempresa__actacodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$actaempresa__esaccodigos = $objServ->formatString($actaempresa__esaccodigos);
			if ($actaempresa__acemfeccren == "") {
				$actaempresa__acemfeccren = $sbDbNull;
			}
			if ($objServ->isInteger($actaempresa__acemfeccren) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			if ($actaempresa__acemfecaten == "") {
				$actaempresa__acemfecaten = $sbDbNull;
			}
			if ($objServ->isInteger($actaempresa__acemfecaten) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			if ($actaempresa__acemhorainn == "") {
				$actaempresa__acemhorainn = $sbDbNull;
			}
			if ($objServ->isInteger($actaempresa__acemhorainn) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			if ($actaempresa__acemhorafin == "") {
				$actaempresa__acemhorafin = $sbDbNull;
			}
			if ($objServ->isInteger($actaempresa__acemhorafin) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			
			if ($actaempresa__acemusumods == "" ||$actaempresa__acemusumods !=NULL) {
				$actaempresa__acemusumods = $sbDbNull;
			}
			
			$actaempresa__acemobservas = $objServ->formatString($actaempresa__acemobservas);
			$actaempresa_manager = Application :: getDomainController('ActaempresaManager');
			$message = $actaempresa_manager->updateActaempresa($actaempresa__actacodigos, $actaempresa__acemnumeros, $actaempresa__esaccodigos, $actaempresa__acemfeccren, $actaempresa__acemfecaten, $actaempresa__acemhorainn, $actaempresa__acemhorafin, $actaempresa__acemobservas,$actaempresa__acemusumods);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>