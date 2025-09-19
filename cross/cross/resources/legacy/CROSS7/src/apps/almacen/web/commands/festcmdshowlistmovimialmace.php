<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListMovimialmace {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("movimialmace__moalcodigos"))
           WebSession::setProperty("movimialmace__moalcodigos",$movimialmace__moalcodigos);
       if(!WebSession::issetProperty("movimialmace__bodecodigos"))
           WebSession::setProperty("movimialmace__bodecodigos",$movimialmace__bodecodigos);
       if(!WebSession::issetProperty("movimialmace__recucodigos"))
           WebSession::setProperty("movimialmace__recucodigos",$movimialmace__recucodigos);
       if(!WebSession::issetProperty("movimialmace__moalfechmovd"))
           WebSession::setProperty("movimialmace__moalfechmovd",$movimialmace__moalfechmovd);
       if(!WebSession::issetProperty("movimialmace__comocodigos"))
           WebSession::setProperty("movimialmace__comocodigos",$movimialmace__comocodigos);
       if(!WebSession::issetProperty("movimialmace__moalcantrecf"))
           WebSession::setProperty("movimialmace__moalcantrecf",$movimialmace__moalcantrecf);
       if(!WebSession::issetProperty("movimialmace__perscodigos"))
           WebSession::setProperty("movimialmace__perscodigos",$movimialmace__perscodigos);
       if(!WebSession::issetProperty("movimialmace__tidocodigos"))
           WebSession::setProperty("movimialmace__tidocodigos",$movimialmace__tidocodigos);
       if(!WebSession::issetProperty("movimialmace__moalnumedocs"))
           WebSession::setProperty("movimialmace__moalnumedocs",$movimialmace__moalnumedocs);
       if(!WebSession::issetProperty("movimialmace__moalsignos"))
           WebSession::setProperty("movimialmace__moalsignos",$movimialmace__moalsignos);
        return "success";  
    }
}
?>	
