<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListRecurso {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("recurso__recucodigos"))
           WebSession::setProperty("recurso__recucodigos",$recurso__recucodigos);
       if(!WebSession::issetProperty("recurso__recunombres"))
           WebSession::setProperty("recurso__recunombres",$recurso__recunombres);
       if(!WebSession::issetProperty("recurso__grrecodigos"))
           WebSession::setProperty("recurso__grrecodigos",$recurso__grrecodigos);
       if(!WebSession::issetProperty("recurso__tirecodigos"))
           WebSession::setProperty("recurso__tirecodigos",$recurso__tirecodigos);
       if(!WebSession::issetProperty("recurso__unmecodigos"))
           WebSession::setProperty("recurso__unmecodigos",$recurso__unmecodigos);
       if(!WebSession::issetProperty("recurso__recudescrips"))
           WebSession::setProperty("recurso__recudescrips",$recurso__recudescrips);
        return "success";  
    }
}
?>	
