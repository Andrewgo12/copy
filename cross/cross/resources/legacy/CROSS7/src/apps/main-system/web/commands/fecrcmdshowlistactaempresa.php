<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdShowListActaempresa {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("actaempresa__actacodigos"))
           WebSession::setProperty("actaempresa__actacodigos",$actaempresa__actacodigos);
       if(!WebSession::issetProperty("actaempresa__acemnumeros"))
           WebSession::setProperty("actaempresa__acemnumeros",$actaempresa__acemnumeros);
       if(!WebSession::issetProperty("actaempresa__esaccodigos"))
           WebSession::setProperty("actaempresa__esaccodigos",$actaempresa__esaccodigos);
       if(!WebSession::issetProperty("actaempresa__acemfeccren"))
           WebSession::setProperty("actaempresa__acemfeccren",$actaempresa__acemfeccren);
       if(!WebSession::issetProperty("actaempresa__acemfecaten"))
           WebSession::setProperty("actaempresa__acemfecaten",$actaempresa__acemfecaten);
       if(!WebSession::issetProperty("actaempresa__acemhorainn"))
           WebSession::setProperty("actaempresa__acemhorainn",$actaempresa__acemhorainn);
       if(!WebSession::issetProperty("actaempresa__acemhorafin"))
           WebSession::setProperty("actaempresa__acemhorafin",$actaempresa__acemhorafin);
       if(!WebSession::issetProperty("actaempresa__acemobservas"))
           WebSession::setProperty("actaempresa__acemobservas",$actaempresa__acemobservas);
        return "success";  
    }
}
?>	
