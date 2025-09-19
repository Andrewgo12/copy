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

Class FePrCmdDeleteStyle {

    function execute()
    {
        extract($_REQUEST);
        
        if(($style__stylcodigos != NULL) && ($style__stylcodigos != "") && ($style__applcodigos != NULL) && ($style__applcodigos != "")){
           $style_manager = Application::getDomainController('StyleManager'); 
           $message = $style_manager->deleteStyle($style__stylcodigos,$style__applcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
