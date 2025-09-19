<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdShowListPregformula {

    function execute()
    {
       extract($_REQUEST);
       
       if(!WebSession::issetProperty("pregformula__pregcodigon"))
           WebSession::setProperty("pregformula__pregcodigon",$pregformula__pregcodigon);

       if(!WebSession::issetProperty("pregformula__formcodigon"))
           WebSession::setProperty("pregformula__formcodigon",$pregformula__formcodigon);

        return "success";  
    }

}

?>	
