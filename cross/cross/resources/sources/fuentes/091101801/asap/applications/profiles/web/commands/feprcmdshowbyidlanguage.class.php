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

Class FePrCmdShowByIdLanguage {

    function execute()
    {
        extract($_REQUEST);

        if(($language__langcodigos != NULL) && ($language__langcodigos != "")){
           $language_manager = Application::getDomainController('LanguageManager'); 
           $language_data = $language_manager->getByIdLanguage($language__langcodigos); 
           
           $_REQUEST["language__langcodigos"] = $language_data[0]["langcodigos"];
           $_REQUEST["language__langnombres"] = $language_data[0]["langnombres"];
           $_REQUEST["language__langobservas"] = $language_data[0]["langobservas"];

        }else{
		
           $_REQUEST["language__langcodigos"] = WebSession::getProperty("language__langcodigos");
           $_REQUEST["language__langnombres"] = WebSession::getProperty("language__langnombres");
           $_REQUEST["language__langobservas"] = WebSession::getProperty("language__langobservas");		
        }
		
        WebSession::unsetProperty("language__langcodigos");
        WebSession::unsetProperty("language__langnombres");
        WebSession::unsetProperty("language__langobservas");

        return "success";       
    }

}

?>	
