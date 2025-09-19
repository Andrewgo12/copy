<?php   
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";
Class FeScCmdDefaultCitasWeb {

	function execute() {

		extract($_REQUEST);
		settype($objService, "object");
		settype($rcConf, "array");
		settype($rcUser, "array");
		settype($nuMessage, "integer");

		//Se obtienen los datos de configuracion de la inetrfaz Web
		$rcUser["schema"] = $context;
		
		if($_REQUEST["lang"])
			$rcUser["lang"] = $_REQUEST["lang"];
		else if($_SESSION["_authsession"]["lang"])
			$rcUser["lang"] = $_SESSION["_authsession"]["lang"];
		WebSession :: setProperty("_authsession", $rcUser);
		
		$objService = Application :: loadServices('General');
		$rcConf = $objService->getParam("cross300", "web_user_conf");
		if ($rcConf) {
			//se obtienen los datos del usuario
			$objService = Application :: loadServices('Profiles');
			$rcUser = $objService->getAuth($rcConf["user"], $rcConf["password"]);
			
			if (!is_array($rcUser)) {
				WebRequest :: setProperty('cod_message', $nuMessage = 30);
				return "fail";
			}
			//Pone en sesion los datos del usuario
			$rcUser["schema"] = $context;
			if($_REQUEST["lang"])
				$rcUser["lang"] = $_REQUEST["lang"];
			else if($_SESSION["_authsession"]["lang"])
				$rcUser["lang"] = $_SESSION["_authsession"]["lang"];
			WebSession :: setProperty("_authsession", $rcUser);
			
			//se montan al $_REQUEST los valores de la forma
			$_REQUEST["ordenempresa__orgacodigos"] = $rcConf["orgacodigos"];
			$objService = Application :: loadServices('DateController');
			$_REQUEST["orden__ordefecregd"] = $objService->fncformatofechahora($objService->fncintdatehour() );
			$_REQUEST["ordenempresa__merecodigos"] = $rcConf["merecodigos"];
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 30);
			return "fail";
		}
		//SI limpia el $_REQUEST
		if ($clean) {
			$this->UnsetRequest();
			unset ($_REQUEST["clean"]);
		}
		return "success";
	}
	function UnsetRequest() {
		settype($sbKey, "string");
		settype($sbValue, "string");

		foreach ($_REQUEST as $sbKey => $sbValue) {
			if (strpos($sbKey,"__")!==false) {
				if ($sbKey != "ordenempresa__orgacodigos" && $sbKey != "orden__ordefecregd" && $sbKey != "ordenempresa__merecodigos") {
					unset ($_REQUEST[$sbKey]);
				}
			}
		}
		unset ($_REQUEST["contacto__contcodigon"]);
		unset ($_REQUEST["contacto__contnombre"]);
		unset ($_REQUEST["contacto__contemail"]);
		unset ($_REQUEST["contacto_locacodigos"]);
		unset ($_REQUEST["contacto_locacodigos_desc"]);
		unset ($_REQUEST["contacto__contdirecios"]);
		unset ($_REQUEST["contacto__conttelefons"]);
		unset ($_REQUEST["categodigon"]);
		unset ($_REQUEST["orgacodigos"]);
	}
}
?>