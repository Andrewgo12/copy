<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdShowListEstadoproces {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("estadoproces__esprcodigos"))
           WebSession::setProperty("estadoproces__esprcodigos",$estadoproces__esprcodigos);

       if(!WebSession::issetProperty("estadoproces__esprnombres"))
           WebSession::setProperty("estadoproces__esprnombres",$estadoproces__esprnombres);

       if(!WebSession::issetProperty("estadoproces__esprdescrips"))
           WebSession::setProperty("estadoproces__esprdescrips",$estadoproces__esprdescrips);

       if(!WebSession::issetProperty("estadoproces__espractivas"))
           WebSession::setProperty("estadoproces__espractivas",$estadoproces__espractivas);

        return "success";  
    }

}

?>	
