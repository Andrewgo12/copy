<?php
/**
	Propiedad intelectual de FullEngine
	Carga la forma del Administrador de tareas
	@author creyes <cesar.reyes@parquesoft.com>
	@date 24-ago-2004 13:04:25
	@location Cali-Colombia
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultTransferTareas {
	function execute() {
		if($_REQUEST["orgacodigos"]){
			$_REQUEST["orgacodigost"] = $_REQUEST["orgacodigos"];
			$_REQUEST["orgacodigost_desc"] = $_REQUEST["orgacodigos_desc"];
		}
		return "success";
	}
}
?>