<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateProveedor {
	function execute() {
		extract($_REQUEST);
		if (($proveedor__provcodigos != NULL) && ($proveedor__provcodigos != "") && ($proveedor__provnombres != NULL) && ($proveedor__provnombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($proveedor__provcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$proveedor__provnnomreprs = $objServ->formatString($proveedor__provnnomreprs);
			$proveedor__provdireccis = $objServ->formatString($proveedor__provdireccis);
			$proveedor__protelefons = $objServ->formatString($proveedor__protelefons);
			$proveedor__provemails = $objServ->formatString($proveedor__provemails);
			$proveedor__provwebs = $objServ->formatString($proveedor__provwebs);
			$proveedor__paiscodigos = $objServ->formatString($proveedor__paiscodigos);
			$proveedor__depacodigos = $objServ->formatString($proveedor__depacodigos);
			$proveedor__ciudcodigos = $objServ->formatString($proveedor__ciudcodigos);
			$proveedor_manager = Application :: getDomainController('ProveedorManager');
			$message = $proveedor_manager->updateProveedor($proveedor__provcodigos, $proveedor__provnombres, $proveedor__provnnomreprs, $proveedor__provdireccis, $proveedor__protelefons, $proveedor__provemails, $proveedor__provwebs, $proveedor__paiscodigos, $proveedor__depacodigos, $proveedor__ciudcodigos, $proveedor__provactivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	
