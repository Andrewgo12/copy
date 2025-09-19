<?php

/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdContrato {
	function execute() {
		extract($_REQUEST);
		if (($contrato__contnics != NULL) && ($contrato__contnics != "")) {
			$contrato_manager = Application :: getDomainController('ContratoManager');
			$contrato_data = $contrato_manager->getByIdContrato($contrato__contnics);

			//Consulta los datos del cliente            
			$cliente_manager = Application :: getDomainController('ClienteManager');
			$cliente_data = $cliente_manager->getByIdentif($contrato_data[0]["clieidentifs"]);

			$_REQUEST["contrato__contnics"] = $contrato_data[0]["contnics"];
			$_REQUEST["contrato__clieidentifs"] = $contrato_data[0]["clieidentifs"];
			$_REQUEST["contrato_clieidentifs_desc"] = $cliente_data[0]["clienombres"];
			$_REQUEST["contrato__ticocodigos"] = $contrato_data[0]["ticocodigos"];
			$_REQUEST["contrato_contobjetos"] = $contrato_data[0]["contobjetos"];
			$_REQUEST["contrato__timocodigos"] = $contrato_data[0]["timocodigos"];
			$_REQUEST["contrato__contmonton"] = $contrato_data[0]["contmonton"];
			$_REQUEST["contrato__fopacodigos"] = $contrato_data[0]["fopacodigos"];
			$_REQUEST["contrato__contfchainin"] = $contrato_data[0]["contfchainin"];
			$_REQUEST["contrato__contfchafinn"] = $contrato_data[0]["contfchafinn"];
			$_REQUEST["contrato__contfchfirmn"] = $contrato_data[0]["contfchfirmn"];
			$_REQUEST["contrato__contestados"] = $contrato_data[0]["contestados"];
			$_REQUEST["contrato_contdescrips"] = $contrato_data[0]["contdescrips"];
		} else {
			$_REQUEST["contrato__contnics"] = WebSession :: getProperty("contrato__contnics");
			$_REQUEST["contrato__clieidentifs"] = WebSession :: getProperty("contrato__clieidentifs");
			$_REQUEST["contrato_clieidentifs_desc"] = WebSession :: getProperty("contrato_clieidentifs_desc");
			$_REQUEST["contrato__ticocodigos"] = WebSession :: getProperty("contrato__ticocodigos");
			$_REQUEST["contrato_contobjetos"] = WebSession :: getProperty("contrato_contobjetos");
			$_REQUEST["contrato__timocodigos"] = WebSession :: getProperty("contrato__timocodigos");
			$_REQUEST["contrato__contmonton"] = WebSession :: getProperty("contrato__contmonton");
			$_REQUEST["contrato__fopacodigos"] = WebSession :: getProperty("contrato__fopacodigos");
			$_REQUEST["contrato__contfchainin"] = WebSession :: getProperty("contrato__contfchainin");
			$_REQUEST["contrato__contfchafinn"] = WebSession :: getProperty("contrato__contfchafinn");
			$_REQUEST["contrato__contfchfirmn"] = WebSession :: getProperty("contrato__contfchfirmn");
			$_REQUEST["contrato__contestados"] = WebSession :: getProperty("contrato__contestados");
			$_REQUEST["contrato_contdescrips"] = WebSession :: getProperty("contrato_contdescrips");
		}
		WebSession :: unsetProperty("contrato__contnics");
		WebSession :: unsetProperty("contrato__clieidentifs");
		WebSession :: unsetProperty("contrato_clieidentifs_desc");
		WebSession :: unsetProperty("contrato__ticocodigos");
		WebSession :: unsetProperty("contrato_contobjetos");
		WebSession :: unsetProperty("contrato__timocodigos");
		WebSession :: unsetProperty("contrato__contmonton");
		WebSession :: unsetProperty("contrato__fopacodigos");
		WebSession :: unsetProperty("contrato__contfchainin");
		WebSession :: unsetProperty("contrato__contfchafinn");
		WebSession :: unsetProperty("contrato__contfchfirmn");
		WebSession :: unsetProperty("contrato__contestados");
		WebSession :: unsetProperty("contrato_contdescrips");
		return "success";
	}
}
?>	

