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

Class FePrCmdShowListApplications {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("applications__applcodigos"))
           WebSession::setProperty("applications__applcodigos",$applications__applcodigos);

       if(!WebSession::issetProperty("applications__applnombres"))
           WebSession::setProperty("applications__applnombres",$applications__applnombres);

       if(!WebSession::issetProperty("applications__applobservas"))
           WebSession::setProperty("applications__applobservas",$applications__applobservas);

        return "success";  
    }

}

?>	
