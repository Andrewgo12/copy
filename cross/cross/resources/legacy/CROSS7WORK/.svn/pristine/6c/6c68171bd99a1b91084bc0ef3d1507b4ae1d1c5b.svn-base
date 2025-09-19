<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdCancelShowListContacto {

    function execute()
    {
        
        $_REQUEST["contacto__contcodigon"] = WebSession::getProperty("contacto__contcodigon");
        $_REQUEST["contacto__contindentis"] = WebSession::getProperty("contacto__contindentis");
        $_REQUEST["contacto__tiidcodigos"] = WebSession::getProperty("contacto__tiidcodigos");
        $_REQUEST["contacto__cliecodigon"] = WebSession::getProperty("contacto__cliecodigon");
        $_REQUEST["contacto__contnombre"] = WebSession::getProperty("contacto__contnombre");
        $_REQUEST["contacto__contemail"] = WebSession::getProperty("contacto__contemail");
        $_REQUEST["contacto__locacodigos"] = WebSession::getProperty("contacto__locacodigos");
        $_REQUEST["contacto_locacodigos_desc"] = WebSession::getProperty("contacto_locacodigos_desc");
        $_REQUEST["contacto__contdirecios"] = WebSession::getProperty("contacto__contdirecios");
        $_REQUEST["contacto__conttelefons"] = WebSession::getProperty("contacto__conttelefons");
        $_REQUEST["contacto__contobservs"] = WebSession::getProperty("contacto__contobservs");
        $_REQUEST["contacto__contsexos"] = WebSession::getProperty("contacto__contsexos");
        $_REQUEST["contacto__contfecnacis"] = WebSession::getProperty("contacto__contfecnacis");
        
	    
        WebSession::unsetProperty("contacto__contcodigon");
        WebSession::unsetProperty("contacto__contindentis");
        WebSession::unsetProperty("contacto__tiidcodigos");
        WebSession::unsetProperty("contacto__cliecodigon");
        WebSession::unsetProperty("contacto__contnombre");
        WebSession::unsetProperty("contacto__contemail");
        WebSession::unsetProperty("contacto__locacodigos");
        WebSession::unsetProperty("contacto_locacodigos_desc");
        WebSession::unsetProperty("contacto__contdirecios");
        WebSession::unsetProperty("contacto__conttelefons");
        WebSession::unsetProperty("contacto__contobservs");
        WebSession::unsetProperty("contacto__contsexos");
        WebSession::unsetProperty("contacto__contfecnacis");
		
        return "success";  
    }

}

?>