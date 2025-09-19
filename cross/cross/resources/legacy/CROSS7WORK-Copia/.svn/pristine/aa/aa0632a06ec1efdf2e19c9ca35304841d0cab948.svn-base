<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeHrCmdShowListGrupodetalle {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("grupodetalle__grupcodigon"))
           WebSession::setProperty("grupodetalle__grupcodigon",$grupodetalle__grupcodigon);

       if(!WebSession::issetProperty("grupodetalle__perscodigos"))
           WebSession::setProperty("grupodetalle__perscodigos",$grupodetalle__perscodigos);

       if(!WebSession::issetProperty("grupodetalle__persrespons"))
           WebSession::setProperty("grupodetalle__persrespons",$grupodetalle__persrespons);

        return "success";  
    }
}
?>