<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de consultar todos a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdShowListCommands {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("commands__commnombres"))
           WebSession::setProperty("commands__commnombres",$commands__commnombres);

       if(!WebSession::issetProperty("commands__applcodigos"))
           WebSession::setProperty("commands__applcodigos",$commands__applcodigos);

       if(!WebSession::issetProperty("commands__commobservas"))
           WebSession::setProperty("commands__commobservas",$commands__commobservas);

        return "success";  
    }

}

?>	
