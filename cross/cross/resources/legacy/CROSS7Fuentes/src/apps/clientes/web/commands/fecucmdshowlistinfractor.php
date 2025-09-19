<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCuCmdShowListInfractor {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("infractor__tiidcodigos"))
           WebSession::setProperty("infractor__tiidcodigos",$infractor__tiidcodigos);

       if(!WebSession::issetProperty("infractor__infrcodigos"))
           WebSession::setProperty("infractor__infrcodigos",$infractor__infrcodigos);

       if(!WebSession::issetProperty("infractor__ticlcodigos"))
           WebSession::setProperty("infractor__ticlcodigos",$infractor__ticlcodigos);

       if(!WebSession::issetProperty("infractor__infrnombres"))
           WebSession::setProperty("infractor__infrnombres",$infractor__infrnombres);

       if(!WebSession::issetProperty("infractor__infrrepreses"))
           WebSession::setProperty("infractor__infrrepreses",$infractor__infrrepreses);

       if(!WebSession::issetProperty("infractor__infrlocalizs"))
           WebSession::setProperty("infractor__infrlocalizs",$infractor__infrlocalizs);

       if(!WebSession::issetProperty("infractor__infrtelefons"))
           WebSession::setProperty("infractor__infrtelefons",$infractor__infrtelefons);

       if(!WebSession::issetProperty("infractor__locacodigos"))
           WebSession::setProperty("infractor__locacodigos",$infractor__locacodigos);

       if(!WebSession::issetProperty("infractor__infrnumfaxs"))
           WebSession::setProperty("infractor__infrnumfaxs",$infractor__infrnumfaxs);

       if(!WebSession::issetProperty("infractor__infractivas"))
           WebSession::setProperty("infractor__infractivas",$infractor__infractivas);

        return "success";  
    }

}

?>	
