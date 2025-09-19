<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultActuareq {
    function execute() {
        extract($_REQUEST);
        //SI limpia el $_REQUEST
        if (($clean_table)) {
            $listadoOrden_manager = Application :: getDomainController("ActuareqManager");
            $listadoOrden_manager->UnsetRequest();
            unset ($_REQUEST["clean_table"]);
        }
        return "success";  
    }
}
?>