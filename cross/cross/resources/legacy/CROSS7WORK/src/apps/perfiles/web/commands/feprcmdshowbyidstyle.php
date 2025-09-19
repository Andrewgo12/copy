<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de consultar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdShowByIdStyle {

    function execute()
    {
        extract($_REQUEST);

        if(($style__stylcodigos != NULL) && ($style__stylcodigos != "") && ($style__applcodigos != NULL) && ($style__applcodigos != "")){
           $style_manager = Application::getDomainController('StyleManager'); 
           $style_data = $style_manager->getByIdStyle($style__stylcodigos,$style__applcodigos); 
           
           $_REQUEST["style__stylcodigos"] = $style_data[0]["stylcodigos"];
           $_REQUEST["style__applcodigos"] = $style_data[0]["applcodigos"];
           $_REQUEST["style__stylnombres"] = $style_data[0]["stylnombres"];
           $_REQUEST["style__stylobservas"] = $style_data[0]["stylobservas"];

        }else{
		
           $_REQUEST["style__stylcodigos"] = WebSession::getProperty("style__stylcodigos");
           $_REQUEST["style__applcodigos"] = WebSession::getProperty("style__applcodigos");
           $_REQUEST["style__stylnombres"] = WebSession::getProperty("style__stylnombres");
           $_REQUEST["style__stylobservas"] = WebSession::getProperty("style__stylobservas");		
        }
		
        WebSession::unsetProperty("style__stylcodigos");
        WebSession::unsetProperty("style__applcodigos");
        WebSession::unsetProperty("style__stylnombres");
        WebSession::unsetProperty("style__stylobservas");

        return "success";       
    }

}

?>	
