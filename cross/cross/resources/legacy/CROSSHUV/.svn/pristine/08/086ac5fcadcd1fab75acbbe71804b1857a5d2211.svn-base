<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdProveedor {
    function execute()
    {
        extract($_REQUEST);
        if(($proveedor__provcodigos != NULL) && ($proveedor__provcodigos != "")){
           $proveedor_manager = Application::getDomainController('ProveedorManager'); 
           $proveedor_data = $proveedor_manager->getByIdProveedor($proveedor__provcodigos); 
           $_REQUEST["proveedor__provcodigos"] = $proveedor_data[0]["provcodigos"];
           $_REQUEST["proveedor__provnombres"] = $proveedor_data[0]["provnombres"];
           $_REQUEST["proveedor__provnnomreprs"] = $proveedor_data[0]["provnnomreprs"];
           $_REQUEST["proveedor__provdireccis"] = $proveedor_data[0]["provdireccis"];
           $_REQUEST["proveedor__protelefons"] = $proveedor_data[0]["protelefons"];
           $_REQUEST["proveedor__provemails"] = $proveedor_data[0]["provemails"];
           $_REQUEST["proveedor__provwebs"] = $proveedor_data[0]["provwebs"];
           $_REQUEST["proveedor__paiscodigos"] = $proveedor_data[0]["paiscodigos"];
           $_REQUEST["proveedor__depacodigos"] = $proveedor_data[0]["depacodigos"];
           $_REQUEST["proveedor__ciudcodigos"] = $proveedor_data[0]["ciudcodigos"];
           $_REQUEST["proveedor__provactivas"] = $proveedor_data[0]["provactivas"];
        }else{
           $_REQUEST["proveedor__provcodigos"] = WebSession::getProperty("proveedor__provcodigos");
           $_REQUEST["proveedor__provnombres"] = WebSession::getProperty("proveedor__provnombres");
           $_REQUEST["proveedor__provnnomreprs"] = WebSession::getProperty("proveedor__provnnomreprs");
           $_REQUEST["proveedor__provdireccis"] = WebSession::getProperty("proveedor__provdireccis");
           $_REQUEST["proveedor__protelefons"] = WebSession::getProperty("proveedor__protelefons");
           $_REQUEST["proveedor__provemails"] = WebSession::getProperty("proveedor__provemails");
           $_REQUEST["proveedor__provwebs"] = WebSession::getProperty("proveedor__provwebs");
           $_REQUEST["proveedor__paiscodigos"] = WebSession::getProperty("proveedor__paiscodigos");
           $_REQUEST["proveedor__depacodigos"] = WebSession::getProperty("proveedor__depacodigos");
           $_REQUEST["proveedor__ciudcodigos"] = WebSession::getProperty("proveedor__ciudcodigos");		
           $_REQUEST["proveedor__provactivas"] = WebSession::getProperty("proveedor__provactivas");
        }
        WebSession::unsetProperty("proveedor__provcodigos");
        WebSession::unsetProperty("proveedor__provnombres");
        WebSession::unsetProperty("proveedor__provnnomreprs");
        WebSession::unsetProperty("proveedor__provdireccis");
        WebSession::unsetProperty("proveedor__protelefons");
        WebSession::unsetProperty("proveedor__provemails");
        WebSession::unsetProperty("proveedor__provwebs");
        WebSession::unsetProperty("proveedor__paiscodigos");
        WebSession::unsetProperty("proveedor__depacodigos");
        WebSession::unsetProperty("proveedor__ciudcodigos");
        WebSession::unsetProperty("proveedor__provactivas");
        return "success";       
    }
}
?>	
