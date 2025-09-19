<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdTipodocument {
    function execute()
    {
        extract($_REQUEST);
        if(($tipodocument__tidocodigos != NULL) && ($tipodocument__tidocodigos != "")){
           $tipodocument_manager = Application::getDomainController('TipodocumentManager'); 
           $tipodocument_data = $tipodocument_manager->getByIdTipodocument($tipodocument__tidocodigos); 
           $_REQUEST["tipodocument__tidocodigos"] = $tipodocument_data[0]["tidocodigos"];
           $_REQUEST["tipodocument__tidonombres"] = $tipodocument_data[0]["tidonombres"];
           $_REQUEST["tipodocument__tidodescrips"] = $tipodocument_data[0]["tidodescrips"];
           $_REQUEST["tipodocument__tidoactivas"] = $tipodocument_data[0]["tidoactivas"];
        }else{
           $_REQUEST["tipodocument__tidocodigos"] = WebSession::getProperty("tipodocument__tidocodigos");
           $_REQUEST["tipodocument__tidonombres"] = WebSession::getProperty("tipodocument__tidonombres");
           $_REQUEST["tipodocument__tidodescrips"] = WebSession::getProperty("tipodocument__tidodescrips");		
           $_REQUEST["tipodocument__tidoactivas"] = WebSession::getProperty("tipodocument__tidoactivas");		
        }
        WebSession::unsetProperty("tipodocument__tidocodigos");
        WebSession::unsetProperty("tipodocument__tidonombres");
        WebSession::unsetProperty("tipodocument__tidodescrips");
        WebSession::unsetProperty("tipodocument__tidoactivas");
        return "success";       
    }
}
?>	
