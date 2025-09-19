<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdAddConfigarchiv {
	function execute() {
		settype($objServ, "object");
		settype($rctmp, "array");
		settype($sbindex, "string");
		settype($sbvalue, "string");
		settype($sbpos, "string");
		extract($_REQUEST);
		//se limpia el detalle de la configuracion si esta en sesion
		if (WebSession :: issetProperty("Detaconfarch")) {
			WebSession :: unsetProperty("Detaconfarch");
		}
		//se limpia el maestro de la configuracion si esta en sesion
		if (WebSession :: issetProperty("Configarchiv")) {
			WebSession :: unsetProperty("Configarchiv");
		}
		if (($configarchiv__cogacodigos != NULL) && ($configarchiv__cogacodigos != "") 
		&& ($configarchiv__coganombres != NULL) && ($configarchiv__coganombres != "") 
		&& ($configarchiv__cogaobservas != NULL) && ($configarchiv__cogaobservas != "") 
		&& ($configarchiv__tiarcodigos != NULL) && ($configarchiv__tiarcodigos != "") 
		&& ($configarchiv__cogasepafins != NULL) && ($configarchiv__cogasepafins != "") 
		&& ($configarchiv__coarencabezs != NULL) && ($configarchiv__coarencabezs != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($configarchiv__cogacodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos
			if ($configarchiv__cogaposmaess == "") {
				$configarchiv__cogaposmaess = "NULL";
			}else{
				if($configarchiv__cogamarmaess==NULL || $configarchiv__cogamarmaess == ""){
					$configarchiv__cogaposdetas = "NULL";
				}
			}
			if ($objServ->isInteger($configarchiv__cogaposmaess) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			if ($configarchiv__cogaposdetas == "") {
				$configarchiv__cogaposdetas = "NULL";
			}else{
				if($configarchiv__cogamarmaess==NULL || $configarchiv__cogamarmaess == ""){
					$configarchiv__cogaposdetas = "NULL";
				}
			}
			if ($objServ->isInteger($configarchiv__cogaposdetas) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//valida de acuerdo al tipo de archivo
			switch ($configarchiv__tiarcodigos) {
				case "2" :
					if ($configarchiv__cogasepainis == "") {
						WebRequest :: setProperty('cod_message', $message = 10);
						return "fail";
					}
					break;
				default :
					}
			if ($configarchiv__cogamardetas) {
				if($configarchiv__cogamarmaess==NULL || $configarchiv__cogamarmaess == ""){
					$configarchiv__cogamardetas = "";
				}
			}		
			if ($configarchiv__cogamarmaess) {
				if ($configarchiv__cogamardetas == "") {
					WebRequest :: setProperty('cod_message', $message = 11);
					return "fail";
				}
				if ($configarchiv__cogaposmaess == "") {
					WebRequest :: setProperty('cod_message', $message = 11);
					return "fail";
				}
				if ($configarchiv__cogaposdetas == "") {
					WebRequest :: setProperty('cod_message', $message = 11);
					return "fail";
				}
			}
			foreach ($_REQUEST as $sbindex => $sbvalue) {
				$sbpos = strpos($sbindex, "__");
				if (!($sbpos === false)) {
					$rctmp[$sbindex] = $$sbindex;
				}
			}
			WebSession :: setProperty("Configarchiv", $rctmp);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	