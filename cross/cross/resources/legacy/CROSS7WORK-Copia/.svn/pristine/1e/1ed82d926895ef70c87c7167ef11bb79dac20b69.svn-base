<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeHrCmdCancelShowListEstadogrupo {

    function execute()
    {
        
        $_REQUEST["estadogrupo__esgrcodigos"] = WebSession::getProperty("estadogrupo__esgrcodigos");
        $_REQUEST["estadogrupo__esgrnombres"] = WebSession::getProperty("estadogrupo__esgrnombres");
        $_REQUEST["estadogrupo__esgrdescrips"] = WebSession::getProperty("estadogrupo__esgrdescrips");
        $_REQUEST["estadogrupo__esgractivas"] = WebSession::getProperty("estadogrupo__esgractivas");
	    
        WebSession::unsetProperty("estadogrupo__esgrcodigos");
        WebSession::unsetProperty("estadogrupo__esgrnombres");
        WebSession::unsetProperty("estadogrupo__esgrdescrips");
        WebSession::unsetProperty("estadogrupo__esgractivas");
		
        return "success";  
    }

}

?>	
