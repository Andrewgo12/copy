<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Comando para pintar las listas de ayuda
*	@author freina
*	@date 29-Sep-2015 11:57 
*	@location Cali-Colombia
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdTreeHelpEsp {
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