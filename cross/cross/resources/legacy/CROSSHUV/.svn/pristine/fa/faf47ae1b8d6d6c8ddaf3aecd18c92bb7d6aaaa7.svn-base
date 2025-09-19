<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListTipodocument {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tipodocument__tidocodigos"))
           WebSession::setProperty("tipodocument__tidocodigos",$tipodocument__tidocodigos);
       if(!WebSession::issetProperty("tipodocument__tidonombres"))
           WebSession::setProperty("tipodocument__tidonombres",$tipodocument__tidonombres);
       if(!WebSession::issetProperty("tipodocument__tidodescrips"))
           WebSession::setProperty("tipodocument__tidodescrips",$tipodocument__tidodescrips);
        return "success";  
    }
}
?>	
