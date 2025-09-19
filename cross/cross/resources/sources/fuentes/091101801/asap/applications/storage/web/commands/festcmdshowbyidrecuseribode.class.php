<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdRecuseribode {
    function execute()
    {
        extract($_REQUEST);
        if($flag){
           $recuseribode_manager = Application::getDomainController('RecuseribodeManager'); 
           $recuseribode_data = $recuseribode_manager->getByIdRecuseribode(); 
           $_REQUEST["recuseribode__resbnumedocu"] = $recuseribode_data[0]["resbnumedocu"];
           $_REQUEST["recuseribode__recucodigos"] = $recuseribode_data[0]["recucodigos"];
           $_REQUEST["recuseribode__resbserirecu"] = $recuseribode_data[0]["resbserirecu"];
           $_REQUEST["recuseribode__resbbodeactu"] = $recuseribode_data[0]["resbbodeactu"];
           $_REQUEST["recuseribode__resbbodeante"] = $recuseribode_data[0]["resbbodeante"];
           $_REQUEST["recuseribode__resbfechmovi"] = $recuseribode_data[0]["resbfechmovi"];
           $_REQUEST["recuseribode__perscodigos"] = $recuseribode_data[0]["perscodigos"];
        }else{
           $_REQUEST["recuseribode__resbnumedocu"] = WebSession::getProperty("recuseribode__resbnumedocu");
           $_REQUEST["recuseribode__recucodigos"] = WebSession::getProperty("recuseribode__recucodigos");
           $_REQUEST["recuseribode__resbserirecu"] = WebSession::getProperty("recuseribode__resbserirecu");
           $_REQUEST["recuseribode__resbbodeactu"] = WebSession::getProperty("recuseribode__resbbodeactu");
           $_REQUEST["recuseribode__resbbodeante"] = WebSession::getProperty("recuseribode__resbbodeante");
           $_REQUEST["recuseribode__resbfechmovi"] = WebSession::getProperty("recuseribode__resbfechmovi");
           $_REQUEST["recuseribode__perscodigos"] = WebSession::getProperty("recuseribode__perscodigos");		
        }
        WebSession::unsetProperty("recuseribode__resbnumedocu");
        WebSession::unsetProperty("recuseribode__recucodigos");
        WebSession::unsetProperty("recuseribode__resbserirecu");
        WebSession::unsetProperty("recuseribode__resbbodeactu");
        WebSession::unsetProperty("recuseribode__resbbodeante");
        WebSession::unsetProperty("recuseribode__resbfechmovi");
        WebSession::unsetProperty("recuseribode__perscodigos");
        return "success";       
    }
}
?>	
