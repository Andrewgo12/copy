<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListTiporecurso {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tiporecurso__tirecodigos"))
           WebSession::setProperty("tiporecurso__tirecodigos",$tiporecurso__tirecodigos);
       if(!WebSession::issetProperty("tiporecurso__tirenombres"))
           WebSession::setProperty("tiporecurso__tirenombres",$tiporecurso__tirenombres);
       if(!WebSession::issetProperty("tiporecurso__tiredescrips"))
           WebSession::setProperty("tiporecurso__tiredescrips",$tiporecurso__tiredescrips);
        return "success";  
    }
}
?>	
