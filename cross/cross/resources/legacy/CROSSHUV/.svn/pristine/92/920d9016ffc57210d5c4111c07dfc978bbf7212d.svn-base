<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultEstadoTickets {

    function execute() {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if (($clean_table)) {
			$listadoOrden_manager = Application :: getDomainController("ListadoOrdenManager");
			$listadoOrden_manager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		return "success";
    }
}
?>