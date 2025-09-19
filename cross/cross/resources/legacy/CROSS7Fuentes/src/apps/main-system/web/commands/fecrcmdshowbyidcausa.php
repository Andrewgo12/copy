<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowByIdCausa {

    function execute()
    {
        extract($_REQUEST);

        if(($causa__tiorcodigos != NULL) && ($causa__tiorcodigos != "") && ($causa__evencodigos != NULL) && ($causa__evencodigos != "") && ($causa__causcodigos != NULL) && ($causa__causcodigos != "")){
           $causa_manager = Application::getDomainController('CausaManager'); 
           $causa_data = $causa_manager->getByIdCausa($causa__tiorcodigos,$causa__evencodigos,$causa__causcodigos); 
           
           $_REQUEST["causa__tiorcodigos"] = $causa_data[0]["tiorcodigos"];
           $_REQUEST["causa__evencodigos"] = $causa_data[0]["evencodigos"];
           $_REQUEST["causa__causcodigos"] = $causa_data[0]["causcodigos"];
           $_REQUEST["causa__causnombres"] = $causa_data[0]["causnombres"];
           $_REQUEST["causa__causdescrips"] = $causa_data[0]["causdescrips"];
           $_REQUEST["causa__causactivas"] = $causa_data[0]["causactivas"];

        }else{
		
           $_REQUEST["causa__tiorcodigos"] = WebSession::getProperty("causa__tiorcodigos");
           $_REQUEST["causa__evencodigos"] = WebSession::getProperty("causa__evencodigos");
           $_REQUEST["causa__causcodigos"] = WebSession::getProperty("causa__causcodigos");
           $_REQUEST["causa__causnombres"] = WebSession::getProperty("causa__causnombres");
           $_REQUEST["causa__causdescrips"] = WebSession::getProperty("causa__causdescrips");
           $_REQUEST["causa__causactivas"] = WebSession::getProperty("causa__causactivas");		
        }
		
        WebSession::unsetProperty("causa__tiorcodigos");
        WebSession::unsetProperty("causa__evencodigos");
        WebSession::unsetProperty("causa__causcodigos");
        WebSession::unsetProperty("causa__causnombres");
        WebSession::unsetProperty("causa__causdescrips");
        WebSession::unsetProperty("causa__causactivas");

        return "success";       
    }

}

?>	
