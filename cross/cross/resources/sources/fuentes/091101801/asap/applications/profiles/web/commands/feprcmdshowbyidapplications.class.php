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

Class FePrCmdShowByIdApplications {

    function execute()
    {
        extract($_REQUEST);

        if(($applications__applcodigos != NULL) && ($applications__applcodigos != "")){
           $applications_manager = Application::getDomainController('ApplicationsManager'); 
           $applications_data = $applications_manager->getByIdApplications($applications__applcodigos); 
           
           $_REQUEST["applications__applcodigos"] = $applications_data[0]["applcodigos"];
           $_REQUEST["applications__applnombres"] = $applications_data[0]["applnombres"];
           $_REQUEST["applications__applobservas"] = $applications_data[0]["applobservas"];

        }else{
		
           $_REQUEST["applications__applcodigos"] = WebSession::getProperty("applications__applcodigos");
           $_REQUEST["applications__applnombres"] = WebSession::getProperty("applications__applnombres");
           $_REQUEST["applications__applobservas"] = WebSession::getProperty("applications__applobservas");		
        }
		
        WebSession::unsetProperty("applications__applcodigos");
        WebSession::unsetProperty("applications__applnombres");
        WebSession::unsetProperty("applications__applobservas");

        return "success";       
    }

}

?>	
