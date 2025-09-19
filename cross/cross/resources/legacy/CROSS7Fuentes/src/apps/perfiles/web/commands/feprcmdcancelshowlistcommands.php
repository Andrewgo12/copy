<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de cancelar la lista a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdCancelShowListCommands {

    function execute()
    {
        
        $_REQUEST["commands__commnombres"] = WebSession::getProperty("commands__commnombres");
        $_REQUEST["commands__applcodigos"] = WebSession::getProperty("commands__applcodigos");
        $_REQUEST["commands__commobservas"] = WebSession::getProperty("commands__commobservas");
	    
        WebSession::unsetProperty("commands__commnombres");
        WebSession::unsetProperty("commands__applcodigos");
        WebSession::unsetProperty("commands__commobservas");
		
        return "success";  
    }

}

?>	
