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

Class FePrCmdShowListLanguage {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("language__langcodigos"))
           WebSession::setProperty("language__langcodigos",$language__langcodigos);

       if(!WebSession::issetProperty("language__langnombres"))
           WebSession::setProperty("language__langnombres",$language__langnombres);

       if(!WebSession::issetProperty("language__langobservas"))
           WebSession::setProperty("language__langobservas",$language__langobservas);

        return "success";  
    }

}

?>	
