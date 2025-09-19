<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListConcepmovimi {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("concepmovimi__comocodigos"))
           WebSession::setProperty("concepmovimi__comocodigos",$concepmovimi__comocodigos);
       if(!WebSession::issetProperty("concepmovimi__comonombres"))
           WebSession::setProperty("concepmovimi__comonombres",$concepmovimi__comonombres);
       if(!WebSession::issetProperty("concepmovimi__comosentidos"))
           WebSession::setProperty("concepmovimi__comosentidos",$concepmovimi__comosentidos);
       if(!WebSession::issetProperty("concepmovimi__comodescrips"))
           WebSession::setProperty("concepmovimi__comodescrips",$concepmovimi__comodescrips);
       if(!WebSession::issetProperty("concepmovimi__comoactivas"))
           WebSession::setProperty("concepmovimi__comoactivas",$concepmovimi__comoactivas);
        return "success";  
    }
}
?>	
