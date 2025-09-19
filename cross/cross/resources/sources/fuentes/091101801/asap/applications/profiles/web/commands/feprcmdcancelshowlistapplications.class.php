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

Class FePrCmdCancelShowListApplications {

    function execute()
    {
        
        $_REQUEST["applications__applcodigos"] = WebSession::getProperty("applications__applcodigos");
        $_REQUEST["applications__applnombres"] = WebSession::getProperty("applications__applnombres");
        $_REQUEST["applications__applobservas"] = WebSession::getProperty("applications__applobservas");
	    
        WebSession::unsetProperty("applications__applcodigos");
        WebSession::unsetProperty("applications__applnombres");
        WebSession::unsetProperty("applications__applobservas");
		
        return "success";  
    }

}

?>	
