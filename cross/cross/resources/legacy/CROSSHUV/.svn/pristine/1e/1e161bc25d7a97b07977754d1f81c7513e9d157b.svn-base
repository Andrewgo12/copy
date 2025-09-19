<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdShowListActivitarea {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("activitarea__tarecodigos"))
           WebSession::setProperty("activitarea__tarecodigos",$activitarea__tarecodigos);
       if(!WebSession::issetProperty("activitarea__acticodigos"))
           WebSession::setProperty("activitarea__acticodigos",$activitarea__acticodigos);
       if(!WebSession::issetProperty("activitarea__actavalorn"))
           WebSession::setProperty("activitarea__actavalorn",$activitarea__actavalorn);
       if(!WebSession::issetProperty("activitarea__actaobligats"))
           WebSession::setProperty("activitarea__actaobligats",$activitarea__actaobligats);
       if(!WebSession::issetProperty("activitarea__actaordenn"))
           WebSession::setProperty("activitarea__actaordenn",$activitarea__actaordenn);
       if(!WebSession::issetProperty("activitarea__actaporcetan"))
           WebSession::setProperty("activitarea__actaporcetan",$activitarea__actaporcetan);
       if(!WebSession::issetProperty("activitarea__actaactivas"))
           WebSession::setProperty("activitarea__actaactivas",$activitarea__actaactivas);
        return "success";  
    }
}
?>	
