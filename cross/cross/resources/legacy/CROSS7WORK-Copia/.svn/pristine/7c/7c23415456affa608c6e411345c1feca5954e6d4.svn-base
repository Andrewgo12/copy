<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdAddPersonal {
	function execute() {
		extract($_REQUEST);
		if (($personal__perscodigos != NULL) && ($personal__perscodigos != "")
		&& ($personal__persidentifs != NULL) && ($personal__persidentifs != "") 
		&& ($personal__persnombres != NULL) && ($personal__persnombres != "") 
		&& ($personal__cargcodigos != NULL) && ($personal__cargcodigos != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($personal__perscodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$personal__persidentifs = $objServ->formatString($personal__persidentifs);
			$personal__persnombres = $objServ->formatString($personal__persnombres);
			$personal__persapell1s = $objServ->formatString($personal__persapell1s);
			$personal__persapell2s = $objServ->formatString($personal__persapell2s);
			$personal__persusrnams = $objServ->formatString($personal__persusrnams);
			$personal__cargcodigos = $objServ->formatString($personal__cargcodigos);
			$personal__persprofecs = $objServ->formatString($personal__persprofecs);
			$personal__perstelefo1 = $objServ->formatString($personal__perstelefo1);
			$personal__perstelefo2 = $objServ->formatString($personal__perstelefo2);
			$personal__locacodigos = $objServ->formatString($personal__locacodigos);
			$personal__persdireccis = $objServ->formatString($personal__persdireccis);
			if ($personal__persemails) {
				if (!$objServ->IsEmail($personal__persemails)) {
					WebRequest :: setProperty('cod_message', $message = 13);
					return "fail";
				}
			}
			$personal__perscontacts = $objServ->formatString($personal__perscontacts);
			$personal__perstelcont = $objServ->formatString($personal__perstelcont);
			$personal_manager = Application :: getDomainController('PersonalManager');
			$message = $personal_manager->addPersonal($personal__perscodigos, 
			$personal__persidentifs, $personal__persnombres, $personal__persapell1s, 
			$personal__persapell2s, $personal__persusrnams, $personal__cargcodigos, 
			$personal__persprofecs, $personal__perstelefo1, $personal__perstelefo2, 
			$personal__locacodigos, $personal__persdireccis, $personal__persemails, 
			$personal__perscontacts, $personal__perstelcont, $personal__persestadoc);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>