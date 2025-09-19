<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdShowByIdTipoarchivo {
    function execute()
    {
        extract($_REQUEST);
        if(($tipoarchivo__tiarcodigos != NULL) && ($tipoarchivo__tiarcodigos != "")){
           $tipoarchivo_manager = Application::getDomainController('TipoarchivoManager'); 
           $tipoarchivo_data = $tipoarchivo_manager->getByIdTipoarchivo($tipoarchivo__tiarcodigos); 
           $_REQUEST["tipoarchivo__tiarcodigos"] = $tipoarchivo_data[0]["tiarcodigos"];
           $_REQUEST["tipoarchivo__tiarnombres"] = $tipoarchivo_data[0]["tiarnombres"];
           $_REQUEST["tipoarchivo__tiarobservas"] = $tipoarchivo_data[0]["tiarobservas"];
           $_REQUEST["tipoarchivo__tiarestados"] = $tipoarchivo_data[0]["tiarestados"];
        }else{
           $_REQUEST["tipoarchivo__tiarcodigos"] = WebSession::getProperty("tipoarchivo__tiarcodigos");
           $_REQUEST["tipoarchivo__tiarnombres"] = WebSession::getProperty("tipoarchivo__tiarnombres");
           $_REQUEST["tipoarchivo__tiarobservas"] = WebSession::getProperty("tipoarchivo__tiarobservas");
           $_REQUEST["tipoarchivo__tiarestados"] = WebSession::getProperty("tipoarchivo__tiarestados");		
        }
        WebSession::unsetProperty("tipoarchivo__tiarcodigos");
        WebSession::unsetProperty("tipoarchivo__tiarnombres");
        WebSession::unsetProperty("tipoarchivo__tiarobservas");
        WebSession::unsetProperty("tipoarchivo__tiarestados");
        return "success";       
    }
}
?>	
