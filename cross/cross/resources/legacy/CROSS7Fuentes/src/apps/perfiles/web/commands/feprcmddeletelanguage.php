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

Class FePrCmdDeleteLanguage {

    function execute()
    {
        extract($_REQUEST);
        
        if(($language__langcodigos != NULL) && ($language__langcodigos != "")){
           $language_manager = Application::getDomainController('LanguageManager'); 
           $message = $language_manager->deleteLanguage($language__langcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
