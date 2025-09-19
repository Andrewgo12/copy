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

Class FePrCmdDeleteApplications {

    function execute()
    {
        extract($_REQUEST);
        
        if(($applications__applcodigos != NULL) && ($applications__applcodigos != "")){
           $applications_manager = Application::getDomainController('ApplicationsManager'); 
           $message = $applications_manager->deleteApplications($applications__applcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
