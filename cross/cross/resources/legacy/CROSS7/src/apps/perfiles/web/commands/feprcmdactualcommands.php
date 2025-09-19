<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Actualiza los comandos de una aplicación con respecto a la base de datos
*	@param array  
*	@author creyes
*	@date 09-ago-2004 16:34:41
*	@location Cali-Colombia
*/
require_once "Web/WebRequest.class.php";
class FePrCmdActualCommands {
    function execute()
    {
		extract($_REQUEST);
		if(($commands__applcodigos != NULL) && ($commands__applcodigos != "")){
			WebRequest::setProperty('applcodigos',&$commands__applcodigos);
			return "success";
		}else{
            WebRequest::setProperty('cod_message',$message = 6);
            return "fail";
		}					
    }
}
?>