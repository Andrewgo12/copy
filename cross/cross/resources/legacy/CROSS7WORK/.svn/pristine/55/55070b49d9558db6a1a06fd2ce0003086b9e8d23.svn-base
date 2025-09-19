<?php 

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowByIdContacto {

	function execute() {
		settype($objService,"object");
    	settype($rcTmp,"array");
		extract($_REQUEST);

		if (($contacto__contcodigon != NULL) && ($contacto__contcodigon != "")) {
			//Carga el servicio de customers
			$service = Application :: loadServices("Customers");
			$contacto_manager = $service->loadManager('ContactoManager');
			$contacto_data = $contacto_manager->getByIdContacto($contacto__contcodigon);
			$service->close();
			$_REQUEST["contacto__contcodigon"] = $contacto_data[0]["contcodigon"];
			$_REQUEST["contacto__contindentis"] = $contacto_data[0]["contindentis"];
			$_REQUEST["contacto__tiidcodigos"] = $contacto_data[0]["tiidcodigos"];
			$_REQUEST["contacto__cliecodigon"] = $contacto_data[0]["cliecodigon"];
			$_REQUEST["contacto__contfecnacis"] = $contacto_data[0]["contfecnacis"];
			$_REQUEST["contacto__contsexos"] = $contacto_data[0]["contsexos"];
			$_REQUEST["contacto__contnombre"] = $contacto_data[0]["contnombre"];
			$_REQUEST["contacto__contemail"] = $contacto_data[0]["contemail"];
			if($contacto_data[0]["locacodigos"]){
           		$objService = Application :: loadServices("General");
           		$_REQUEST["contacto__locacodigos"] = $contacto_data[0]["locacodigos"];
           		$rcTmp = $objService->getByIdLocalizacion($_REQUEST["contacto__locacodigos"]);
           		$_REQUEST["contacto_locacodigos_desc"] = $rcTmp[0]["locanombres"];
           }
			$_REQUEST["contacto__contdirecios"] = $contacto_data[0]["contdirecios"];
			$_REQUEST["contacto__conttelefons"] = $contacto_data[0]["conttelefons"];
			$_REQUEST["contacto__contobservs"] = $contacto_data[0]["contobservs"];
			$_REQUEST["contacto__contactivas"] = $contacto_data[0]["contactivas"];

		} else {

			$_REQUEST["contacto__contcodigon"] = WebSession :: getProperty("contacto__contcodigon");
			$_REQUEST["contacto__contindentis"] = WebSession :: getProperty("contacto__contindentis");
			$_REQUEST["contacto__tiidcodigos"] = WebSession::getProperty("contacto__tiidcodigos");
			$_REQUEST["contacto__cliecodigon"] = WebSession :: getProperty("contacto__cliecodigon");
			$_REQUEST["contacto__contfecnacis"] = WebSession :: getProperty("contacto__contfecnacis");
			$_REQUEST["contacto__contsexos"] = WebSession :: getProperty("contacto__contsexos");
			$_REQUEST["contacto__contnombre"] = WebSession :: getProperty("contacto__contnombre");
			$_REQUEST["contacto__contemail"] = WebSession :: getProperty("contacto__contemail");
			$_REQUEST["contacto__locacodigos"] = WebSession :: getProperty("contacto__locacodigos");
			$_REQUEST["contacto_locacodigos_desc"] = WebSession::getProperty("contacto_locacodigos_desc");
			$_REQUEST["contacto__contdirecios"] = WebSession :: getProperty("contacto__contdirecios");
			$_REQUEST["contacto__conttelefons"] = WebSession :: getProperty("contacto__conttelefons");
			$_REQUEST["contacto__contobservs"] = WebSession :: getProperty("contacto__contobservs");
			$_REQUEST["contacto__contactivas"] = WebSession :: getProperty("contacto__contactivas");
		}

		WebSession :: unsetProperty("contacto__contcodigon");
		WebSession :: unsetProperty("contacto__contindentis");
		WebSession :: unsetProperty("contacto__tiidcodigos");
		WebSession :: unsetProperty("contacto__cliecodigon");
		WebSession :: unsetProperty("contacto__contfecnacis");
		WebSession :: unsetProperty("contacto__contsexos");
		WebSession :: unsetProperty("contacto__contnombre");
		WebSession :: unsetProperty("contacto__contemail");
		WebSession :: unsetProperty("contacto__locacodigos");
		WebSession::unsetProperty("contacto_locacodigos_desc");
		WebSession :: unsetProperty("contacto__contdirecios");
		WebSession :: unsetProperty("contacto__conttelefons");
		WebSession :: unsetProperty("contacto__contobservs");
		WebSession :: unsetProperty("contacto__contactivas");

		return "success";
	}

}

?>	
