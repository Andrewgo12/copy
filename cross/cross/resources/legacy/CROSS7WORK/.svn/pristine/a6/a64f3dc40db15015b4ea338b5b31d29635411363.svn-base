<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Comando para pintar las listas de ayuda
*	@author creyes
*	@date 08-Jul-2005 12:05 
*	@location Cali-Colombia
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdTreeHelp {
    function execute(){
    	settype($nuClose,"integer");
    	if($_REQUEST["message"]){
    		extract($_REQUEST);
			WebRequest :: setProperty('cod_message', $message);
			$nuClose = 1;
			WebRequest :: setProperty('close',$nuClose );
		}
        return "success";  
    }
}
?>