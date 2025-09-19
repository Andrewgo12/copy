<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListProveerecurs {
    function execute()
    {
        $_REQUEST["proveerecurs__prrecodigos"] = WebSession::getProperty("proveerecurs__prrecodigos");
        $_REQUEST["proveerecurs__provcodigos"] = WebSession::getProperty("proveerecurs__provcodigos");
        $_REQUEST["proveerecurs__recucodigos"] = WebSession::getProperty("proveerecurs__recucodigos");
        $_REQUEST["proveerecurs__prrevalorecf"] = WebSession::getProperty("proveerecurs__prrevalorecf");
        WebSession::unsetProperty("proveerecurs__prrecodigos");
        WebSession::unsetProperty("proveerecurs__provcodigos");
        WebSession::unsetProperty("proveerecurs__recucodigos");
        WebSession::unsetProperty("proveerecurs__prrevalorecf");
        return "success";  
    }
}
?>	
