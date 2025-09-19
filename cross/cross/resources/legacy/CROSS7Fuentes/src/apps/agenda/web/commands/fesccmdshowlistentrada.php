<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeScCmdShowListEntrada {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("entrada__entrcodigon"))
           WebSession::setProperty("entrada__entrcodigon",$entrada__entrcodigon);

       if(!WebSession::issetProperty("entrada__entrusucreas"))
           WebSession::setProperty("entrada__entrusucreas",$entrada__entrusucreas);

       if(!WebSession::issetProperty("entrada__entrfechorun"))
           WebSession::setProperty("entrada__entrfechorun",$entrada__entrfechorun);

       if(!WebSession::issetProperty("entrada__entrduracion"))
           WebSession::setProperty("entrada__entrduracion",$entrada__entrduracion);

       if(!WebSession::issetProperty("entrada__agprcodigos"))
           WebSession::setProperty("entrada__agprcodigos",$entrada__agprcodigos);

       if(!WebSession::issetProperty("entrada__catecodigon"))
           WebSession::setProperty("entrada__catecodigon",$entrada__catecodigon);

       if(!WebSession::issetProperty("entrada__entrdescris"))
           WebSession::setProperty("entrada__entrdescris",$entrada__entrdescris);

       if(!WebSession::issetProperty("entrada__ordenumeros"))
           WebSession::setProperty("entrada__ordenumeros",$entrada__ordenumeros);

        return "success";  
    }

}

?>	
