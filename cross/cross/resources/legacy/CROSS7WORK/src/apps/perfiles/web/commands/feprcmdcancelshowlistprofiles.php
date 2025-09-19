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

Class FePrCmdCancelShowListProfiles {

    function execute()
    {
        
        $_REQUEST["profiles__profcodigos"] = WebSession::getProperty("profiles__profcodigos");
        $_REQUEST["profiles__applcodigos"] = WebSession::getProperty("profiles__applcodigos");
        $_REQUEST["profiles__profnombres"] = WebSession::getProperty("profiles__profnombres");
        $_REQUEST["profiles__profdescrips"] = WebSession::getProperty("profiles__profdescrips");
	    
        WebSession::unsetProperty("profiles__profcodigos");
        WebSession::unsetProperty("profiles__applcodigos");
        WebSession::unsetProperty("profiles__profnombres");
        WebSession::unsetProperty("profiles__profdescrips");
		
        return "success";  
    }

}
?>