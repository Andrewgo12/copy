<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListProveerecurs {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("proveerecurs__prrecodigos"))
           WebSession::setProperty("proveerecurs__prrecodigos",$proveerecurs__prrecodigos);
       if(!WebSession::issetProperty("proveerecurs__provcodigos"))
           WebSession::setProperty("proveerecurs__provcodigos",$proveerecurs__provcodigos);
       if(!WebSession::issetProperty("proveerecurs__recucodigos"))
           WebSession::setProperty("proveerecurs__recucodigos",$proveerecurs__recucodigos);
       if(!WebSession::issetProperty("proveerecurs__prrevalorecf"))
           WebSession::setProperty("proveerecurs__prrevalorecf",$proveerecurs__prrevalorecf);
        return "success";  
    }
}
?>	
