<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeHrCmdCancelShowListGrupo {

    function execute()
    {
        $_REQUEST["grupo__grupcodigon"] = WebSession::getProperty("grupo__grupcodigon");
        $_REQUEST["grupo__grupcodigos"] = WebSession::getProperty("grupo__grupcodigos");
        $_REQUEST["grupo__grupnombres"] = WebSession::getProperty("grupo__grupnombres");
        $_REQUEST["grupo__esgrcodigos"] = WebSession::getProperty("grupo__esgrcodigos");
        $_REQUEST["grupo__grupfchainin"] = WebSession::getProperty("grupo__grupfchainin");
        $_REQUEST["grupo__grupfchafinn"] = WebSession::getProperty("grupo__grupfchafinn");
	    
        WebSession::unsetProperty("grupo__grupcodigon");
        WebSession::unsetProperty("grupo__grupcodigos");
        WebSession::unsetProperty("grupo__grupnombres");
        WebSession::unsetProperty("grupo__esgrcodigos");
        WebSession::unsetProperty("grupo__grupfchainin");
        WebSession::unsetProperty("grupo__grupfchafinn");
		
        return "success";  
    }

}

?>	
