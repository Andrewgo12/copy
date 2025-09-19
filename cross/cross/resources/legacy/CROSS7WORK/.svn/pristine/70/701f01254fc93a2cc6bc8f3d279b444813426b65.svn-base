<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de Eliminar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/
  
require_once "Web/WebRequest.class.php";

Class FePrCmdDeleteCommands {

    function execute()
    {
        extract($_REQUEST);
        
        if(($commands__commnombres != NULL) && ($commands__commnombres != "") && ($commands__applcodigos != NULL) && ($commands__applcodigos != "")){
           $commands_manager = Application::getDomainController('CommandsManager'); 
           $message = $commands_manager->deleteCommands($commands__commnombres,$commands__applcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
