<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeScCmdShowListCategoria {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("categoria__catecodigon"))
           WebSession::setProperty("categoria__catecodigon",$categoria__catecodigon);

       if(!WebSession::issetProperty("categoria__catenombres"))
           WebSession::setProperty("categoria__catenombres",$categoria__catenombres);

       if(!WebSession::issetProperty("categoria__catedescris"))
           WebSession::setProperty("categoria__catedescris",$categoria__catedescris);

       if(!WebSession::issetProperty("categoria__cateactivas"))
           WebSession::setProperty("categoria__cateactivas",$categoria__cateactivas);

        return "success";  
    }

}

?>	
