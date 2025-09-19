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

Class FePrCmdShowListProfiles {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("profiles__profcodigos"))
           WebSession::setProperty("profiles__profcodigos",$profiles__profcodigos);

       if(!WebSession::issetProperty("profiles__applcodigos"))
           WebSession::setProperty("profiles__applcodigos",$profiles__applcodigos);

       if(!WebSession::issetProperty("profiles__profnombres"))
           WebSession::setProperty("profiles__profnombres",$profiles__profnombres);

       if(!WebSession::issetProperty("profiles__profdescrips"))
           WebSession::setProperty("profiles__profdescrips",$profiles__profdescrips);

        return "success";  
    }
}
?>