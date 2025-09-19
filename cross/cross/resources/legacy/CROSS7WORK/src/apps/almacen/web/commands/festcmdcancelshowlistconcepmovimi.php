<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListConcepmovimi {
    function execute()
    {
        $_REQUEST["concepmovimi__comocodigos"] = WebSession::getProperty("concepmovimi__comocodigos");
        $_REQUEST["concepmovimi__comonombres"] = WebSession::getProperty("concepmovimi__comonombres");
        $_REQUEST["concepmovimi__comosentidos"] = WebSession::getProperty("concepmovimi__comosentidos");
        $_REQUEST["concepmovimi__comodescrips"] = WebSession::getProperty("concepmovimi__comodescrips");
        WebSession::unsetProperty("concepmovimi__comocodigos");
        WebSession::unsetProperty("concepmovimi__comonombres");
        WebSession::unsetProperty("concepmovimi__comosentidos");
        WebSession::unsetProperty("concepmovimi__comodescrips");
        return "success";  
    }
}
?>	
