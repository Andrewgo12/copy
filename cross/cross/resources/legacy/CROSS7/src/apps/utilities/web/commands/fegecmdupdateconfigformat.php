<?php     
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdUpdateConfigformat {
	function execute() {

		extract($_REQUEST);
		settype($detaconfform_manager, "object");
		settype($rcdata, "array");
		settype($rctmpi, "array");
		settype($sbmessage, "string");
		settype($sbindex, "string");
		settype($sbpos, "string");
		settype($sbposd, "string");
		settype($sbvalue, "string");
		settype($nucont, "integer");

		if (($cofocodigon != NULL) && ($cofocodigon != "")) {
			$objServ = Application :: loadServices("Data_type");

			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($cofocodigon) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			if ($objServ->isInteger($cofocodigon) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

			foreach ($_REQUEST as $sbindex => $sbvalue) {

				$sbpos = strpos($sbindex, $table);
				$sbposd = strpos($sbindex, "desc");
				if (($sbpos === 0) && ($sbposd === false) && $sbindex != "configformat__focacodigos") {

					if (!$sbvalue) {
						WebRequest :: setProperty('cod_message', $sbmessage = 0);
						return "fail";
					}

					$rctmpi = explode("__", $sbindex);
					$rcdata[$nucont]["cofocodigon"] = $cofocodigon;
					$rcdata[$nucont]["cacocodigon"] = $_REQUEST[$rctmpi[1]];
					$rcdata[$nucont]["decooperados"] = "=";
					$rcdata[$nucont]["decovalors"] = $sbvalue;
					$nucont ++;
				}
			}

			$detaconfform_manager = Application :: getDomainController('DetaconfformManager');
			$sbmessage = $detaconfform_manager->ActualizarDetalleformato($rcdata);
			WebRequest :: setProperty('cod_message', $sbmessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 0);
			return "fail";
		}
	}
}
?>