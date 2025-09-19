<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowListActividad {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("actividad__acticodigos"))
           WebSession::setProperty("actividad__acticodigos",$actividad__acticodigos);

       if(!WebSession::issetProperty("actividad__actinombres"))
           WebSession::setProperty("actividad__actinombres",$actividad__actinombres);

       if(!WebSession::issetProperty("actividad__activalorn"))
           WebSession::setProperty("actividad__activalorn",$actividad__activalorn);

       if(!WebSession::issetProperty("actividad__actiobservas"))
           WebSession::setProperty("actividad__actiobservas",$actividad__actiobservas);

       if(!WebSession::issetProperty("actividad__actiactivas"))
           WebSession::setProperty("actividad__actiactivas",$actividad__actiactivas);

        return "success";  
    }

}

?>	
