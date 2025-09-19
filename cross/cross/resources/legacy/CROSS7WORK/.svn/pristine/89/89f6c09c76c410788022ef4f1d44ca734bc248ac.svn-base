<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeScCmdCancelShowListEntrada {

    function execute()
    {
        
        $_REQUEST["entrada__entrcodigon"] = WebSession::getProperty("entrada__entrcodigon");
        $_REQUEST["entrada__entrusucreas"] = WebSession::getProperty("entrada__entrusucreas");
        $_REQUEST["entrada__entrfechorun"] = WebSession::getProperty("entrada__entrfechorun");
        $_REQUEST["entrada__entrduracion"] = WebSession::getProperty("entrada__entrduracion");
        $_REQUEST["entrada__agprcodigos"] = WebSession::getProperty("entrada__agprcodigos");
        $_REQUEST["entrada__catecodigon"] = WebSession::getProperty("entrada__catecodigon");
        $_REQUEST["entrada__entrdescris"] = WebSession::getProperty("entrada__entrdescris");
        $_REQUEST["entrada__ordenumeros"] = WebSession::getProperty("entrada__ordenumeros");
	    
        WebSession::unsetProperty("entrada__entrcodigon");
        WebSession::unsetProperty("entrada__entrusucreas");
        WebSession::unsetProperty("entrada__entrfechorun");
        WebSession::unsetProperty("entrada__entrduracion");
        WebSession::unsetProperty("entrada__agprcodigos");
        WebSession::unsetProperty("entrada__catecodigon");
        WebSession::unsetProperty("entrada__entrdescris");
        WebSession::unsetProperty("entrada__ordenumeros");
		
        return "success";  
    }

}

?>	
