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

Class FePrCmdCancelShowListLanguage {

    function execute()
    {
        
        $_REQUEST["language__langcodigos"] = WebSession::getProperty("language__langcodigos");
        $_REQUEST["language__langnombres"] = WebSession::getProperty("language__langnombres");
        $_REQUEST["language__langobservas"] = WebSession::getProperty("language__langobservas");
	    
        WebSession::unsetProperty("language__langcodigos");
        WebSession::unsetProperty("language__langnombres");
        WebSession::unsetProperty("language__langobservas");
		
        return "success";  
    }

}

?>	
