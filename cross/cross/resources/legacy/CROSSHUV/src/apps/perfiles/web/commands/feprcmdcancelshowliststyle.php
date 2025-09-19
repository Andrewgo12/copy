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

Class FePrCmdCancelShowListStyle {

    function execute()
    {
        
        $_REQUEST["style__stylcodigos"] = WebSession::getProperty("style__stylcodigos");
        $_REQUEST["style__applcodigos"] = WebSession::getProperty("style__applcodigos");
        $_REQUEST["style__stylnombres"] = WebSession::getProperty("style__stylnombres");
        $_REQUEST["style__stylobservas"] = WebSession::getProperty("style__stylobservas");
	    
        WebSession::unsetProperty("style__stylcodigos");
        WebSession::unsetProperty("style__applcodigos");
        WebSession::unsetProperty("style__stylnombres");
        WebSession::unsetProperty("style__stylobservas");
		
        return "success";  
    }

}

?>	
