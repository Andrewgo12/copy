<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCuCmdShowByIdContacto {

	function execute() {
		settype($objService, "object");
		settype($rcTmp, "array");
		extract($_REQUEST);

		if (($contacto__contcodigon != NULL) && ($contacto__contcodigon != "")) {
			$contacto_manager = Application :: getDomainController('ContactoManager');
			$contacto_data = $contacto_manager->getByIdContacto($contacto__contcodigon);
			
			$cliente = Application::getDomainController("ClienteManager");
			$cliente_data = $cliente->getByIdCliente($contacto_data[0]["cliecodigon"]);
			
			$_REQUEST["contacto__contcodigon"] = $contacto_data[0]["contcodigon"];
			$_REQUEST["contacto__contindentis"] = $contacto_data[0]["contindentis"];
			$_REQUEST["contacto__tiidcodigos"] = $contacto_data[0]["tiidcodigos"];
			$_REQUEST["contacto__cliecodigos"] = $contacto_data[0]["cliecodigon"];
			if(is_array($cliente_data))
				$_REQUEST["cliecodigos_desc"] = $cliente_data[0]["clienombres"];
			$_REQUEST["contacto__contfecnacis"] = $contacto_data[0]["contfecnacis"];
			$_REQUEST["contacto__contsexos"] = $contacto_data[0]["contsexos"];
			$_REQUEST["contacto__contprinoms"] = $contacto_data[0]["contprinoms"];
			$_REQUEST["contacto__contsegnoms"] = $contacto_data[0]["contsegnoms"];
			$_REQUEST["contacto__contpriapes"] = $contacto_data[0]["contpriapes"];
			$_REQUEST["contacto__contsegapes"] = $contacto_data[0]["contsegapes"];
			$_REQUEST["contacto__contemail"] = $contacto_data[0]["contemail"];
			if ($contacto_data[0]["locacodigos"]) {
				$objService = Application :: loadServices("General");
				$_REQUEST["contacto__locacodigos"] = $contacto_data[0]["locacodigos"];
				$rcTmp = $objService->getByIdLocalizacion($_REQUEST["contacto__locacodigos"]);
				$_REQUEST["contacto_locacodigos_desc"] = $rcTmp[0]["locanombres"];
			}
			$_REQUEST["contacto__contdirecios"] = $contacto_data[0]["contdirecios"];
			$_REQUEST["contacto__conttelefons"] = $contacto_data[0]["conttelefons"];
			$_REQUEST["contacto__contobservs"] = $contacto_data[0]["contobservs"];
			$_REQUEST["contacto__contactivas"] = $contacto_data[0]["contactivas"];
			$_REQUEST["contacto__contnumcels"] = $contacto_data[0]["contnumcels"];
			$_REQUEST["contacto__contedadn"] = $contacto_data[0]["contedadn"];

		} else {

			$_REQUEST["contacto__contcodigon"] = WebSession :: getProperty("contacto__contcodigon");
			$_REQUEST["contacto__contindentis"] = WebSession :: getProperty("contacto__contindentis");
			$_REQUEST["contacto__tiidcodigos"] = WebSession :: getProperty("contacto__tiidcodigos");
			$_REQUEST["contacto__cliecodigon"] = WebSession :: getProperty("contacto__cliecodigon");
			$_REQUEST["contacto__contfecnacis"] = WebSession :: getProperty("contacto__contfecnacis");
			$_REQUEST["contacto__contsexos"] = WebSession :: getProperty("contacto__contsexos");
			$_REQUEST["contacto__contprinoms"] = WebSession :: getProperty("contacto__contprinoms");
			$_REQUEST["contacto__contsegnoms"] = WebSession :: getProperty("contacto__contsegnoms");
			$_REQUEST["contacto__contpriapes"] = WebSession :: getProperty("contacto__contpriapes");
			$_REQUEST["contacto__contsegapes"] = WebSession :: getProperty("contacto__contsegapes");
			$_REQUEST["contacto__contemail"] = WebSession :: getProperty("contacto__contemail");
			$_REQUEST["contacto__locacodigos"] = WebSession :: getProperty("contacto__locacodigos");
			$_REQUEST["contacto_locacodigos_desc"] = WebSession :: getProperty("contacto_locacodigos_desc");
			$_REQUEST["contacto__contdirecios"] = WebSession :: getProperty("contacto__contdirecios");
			$_REQUEST["contacto__conttelefons"] = WebSession :: getProperty("contacto__conttelefons");
			$_REQUEST["contacto__contobservs"] = WebSession :: getProperty("contacto__contobservs");
			$_REQUEST["contacto__contactivas"] = WebSession :: getProperty("contacto__contactivas");
			$_REQUEST["contacto__contnumcels"] = WebSession :: getProperty("contacto__contnumcels");
			$_REQUEST["contacto__contedadn"] = WebSession :: getProperty("contacto__contedadn");
		}

		WebSession :: unsetProperty("contacto__contcodigon");
		WebSession :: unsetProperty("contacto__contindentis");
		WebSession :: unsetProperty("contacto__tiidcodigos");
		WebSession :: unsetProperty("contacto__cliecodigon");
		WebSession :: unsetProperty("contacto__contfecnacis");
		WebSession :: unsetProperty("contacto__contsexos");
		WebSession :: unsetProperty("contacto__contprinoms");
		WebSession :: unsetProperty("contacto__contsegnoms");
		WebSession :: unsetProperty("contacto__contpriapes");
		WebSession :: unsetProperty("contacto__contsegapes");
		WebSession :: unsetProperty("contacto__contemail");
		WebSession :: unsetProperty("contacto__locacodigos");
		WebSession :: unsetProperty("contacto_locacodigos_desc");
		WebSession :: unsetProperty("contacto__contdirecios");
		WebSession :: unsetProperty("contacto__conttelefons");
		WebSession :: unsetProperty("contacto__contobservs");
		WebSession :: unsetProperty("contacto__contactivas");
		WebSession :: unsetProperty("contacto__contnumcels");
		WebSession :: unsetProperty("contacto__contedadn");

		return "success";
	}
}
?>