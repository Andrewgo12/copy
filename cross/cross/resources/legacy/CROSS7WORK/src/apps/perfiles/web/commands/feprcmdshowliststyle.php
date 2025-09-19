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

Class FePrCmdShowListStyle {

    function execute()
    {
       extract($_REQUEST);
		
       if(!WebSession::issetProperty("style__stylcodigos"))
           WebSession::setProperty("style__stylcodigos",$style__stylcodigos);

       if(!WebSession::issetProperty("style__applcodigos"))
           WebSession::setProperty("style__applcodigos",$style__applcodigos);

       if(!WebSession::issetProperty("style__stylnombres"))
           WebSession::setProperty("style__stylnombres",$style__stylnombres);

       if(!WebSession::issetProperty("style__stylobservas"))
           WebSession::setProperty("style__stylobservas",$style__stylobservas);

        return "success";  
    }

}

?>	
