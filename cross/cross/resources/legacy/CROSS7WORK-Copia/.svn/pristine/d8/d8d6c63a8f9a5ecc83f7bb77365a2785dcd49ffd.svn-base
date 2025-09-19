<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowListCompromiso {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("compromiso__compcodigos"))
           WebSession::setProperty("compromiso__compcodigos",$compromiso__compcodigos);

       if(!WebSession::issetProperty("compromiso__compdescris"))
           WebSession::setProperty("compromiso__compdescris",$compromiso__compdescris);

       if(!WebSession::issetProperty("compromiso__compactivos"))
           WebSession::setProperty("compromiso__compactivos",$compromiso__compactivos);

        return "success";  
    }

}

?>	
