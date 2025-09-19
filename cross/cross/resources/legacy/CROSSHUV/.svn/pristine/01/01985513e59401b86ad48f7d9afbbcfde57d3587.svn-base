<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";

Class FeCuCmdCancelShowListContacto {

	function execute() {

		$_REQUEST["contacto__contcodigon"] = WebSession :: getProperty("contacto__contcodigon");
		$_REQUEST["contacto__contindentis"] = WebSession :: getProperty("contacto__contindentis");
		$_REQUEST["contacto__tiidcodigos"] = WebSession::getProperty("contacto__tiidcodigos");
		$_REQUEST["contacto__cliecodigon"] = WebSession :: getProperty("contacto__cliecodigon");
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
		$_REQUEST["contacto__contsexos"] = WebSession :: getProperty("contacto__contsexos");
		$_REQUEST["contacto__contfecnacis"] = WebSession :: getProperty("contacto__contfecnacis");
		$_REQUEST["contacto__contedadn"] = WebSession :: getProperty("contacto__contedadn");
		$_REQUEST["contacto__contnumcels"] = WebSession :: getProperty("contacto__contnumcels");
		$_REQUEST["contacto__grincodigos"] = WebSession :: getProperty("contacto__grincodigos");

		WebSession :: unsetProperty("contacto__contcodigon");
		WebSession :: unsetProperty("contacto__contindentis");
		WebSession::unsetProperty("contacto__tiidcodigos");
		WebSession :: unsetProperty("contacto__cliecodigon");
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
		WebSession :: unsetProperty("contacto__contsexos");
		WebSession :: unsetProperty("contacto__contfecnacis");
		WebSession :: unsetProperty("contacto__contedadn");
		WebSession :: unsetProperty("contacto__contnumcels");
		WebSession :: unsetProperty("contacto__grincodigos");

		return "success";
	}
}
?>