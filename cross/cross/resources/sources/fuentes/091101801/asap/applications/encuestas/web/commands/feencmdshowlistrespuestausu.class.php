<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdShowListRespuestausu {

    function execute()
    {
       extract($_REQUEST);
		
       $objService = Application :: loadServices("Data_type");
		if ($respuestausu__reusvalorabis)
			$_REQUEST["respuestausu__reusvalorabis"] = $objService->formatString($respuestausu__reusvalorabis);
			
       if(!WebSession::issetProperty("respuestausu__usuacodigon"))
           WebSession::setProperty("respuestausu__usuacodigon",$respuestausu__usuacodigon);

       if(!WebSession::issetProperty("respuestausu__formcodigon"))
           WebSession::setProperty("respuestausu__formcodigon",$respuestausu__formcodigon);

       if(!WebSession::issetProperty("respuestausu__pregcodigon"))
           WebSession::setProperty("respuestausu__pregcodigon",$respuestausu__pregcodigon);

       if(!WebSession::issetProperty("respuestausu__reuscodigon"))
           WebSession::setProperty("respuestausu__reuscodigon",$respuestausu__reuscodigon);

       if(!WebSession::issetProperty("respuestausu__varecodigon"))
           WebSession::setProperty("respuestausu__varecodigon",$respuestausu__varecodigon);

       if(!WebSession::issetProperty("respuestausu__respcodigon"))
           WebSession::setProperty("respuestausu__respcodigon",$respuestausu__respcodigon);

       if(!WebSession::issetProperty("respuestausu__reusvalorabis"))
           WebSession::setProperty("respuestausu__reusvalorabis",$respuestausu__reusvalorabis);

        return "success";  
    }

}

?>	
