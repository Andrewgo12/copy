<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";
/**
* @Copyright 2005 Parquesoft
*
* Comando de mostrar el listado de la tabla schema
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FePrCmdShowListSchema {

    function execute(){
    	extract($_REQUEST);
		
       if(!WebSession::issetProperty("schema__schecodigon"))
           WebSession::setProperty("schema__schecodigon",$schema__schecodigon);

       if(!WebSession::issetProperty("schema__schenombres"))
           WebSession::setProperty("schema__schenombres",$schema__schenombres);

       if(!WebSession::issetProperty("schema__schedbusers"))
           WebSession::setProperty("schema__schedbusers",$schema__schedbusers);

       if(!WebSession::issetProperty("schema__schedbkeys"))
           WebSession::setProperty("schema__schedbkeys",$schema__schedbkeys);

       if(!WebSession::issetProperty("schema__scheobservas"))
           WebSession::setProperty("schema__scheobservas",$schema__scheobservas);

    	return "success";  
    }

}

?>	
