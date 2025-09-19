<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";

Class FeCrCmdAddContacto {

	function execute() {
		extract($_REQUEST);

		if (($contacto__contindentis != NULL) && ($contacto__contindentis != "") 
		&& ($contacto__contnombre != NULL) && ($contacto__contnombre != "") 
		&& ($contacto__contsexos != NULL) && ($contacto__contsexos != "") 
		&& ($contacto__tiidcodigos != NULL) && ($contacto__tiidcodigos != "")) {
			
			$objServ = Application :: loadServices("Data_type");
                  $sbdbnull = Application :: getConstant("DB_NULL");

			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($contacto__contindentis) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

			if ($contacto__contfecnacis != "") {
				$serviceDate = Application :: loadServices("DateController");
				if (!$serviceDate->fncvalidatedate($contacto__contfecnacis)) {
					WebRequest :: setProperty('cod_message', $message = 7);
					return "fail";
				}
			}

			$contacto__contindentis = $objServ->formatString($contacto__contindentis);
			$contacto__tiidcodigos = $objServ->formatString($contacto__tiidcodigos);
			$contacto__cliecodigon = $objServ->formatString($contacto__cliecodigon);
			$contacto__contnombre = $objServ->formatString($contacto__contnombre);
			if ($contacto__contemail) {
				if (!$objServ->IsEmail($contacto__contemail)) {
					WebRequest :: setProperty('cod_message', $message = 32);
					return "fail";
				}
			}
			//determina la localidad
			if ($contacto__locacodigos)
				$contacto__locacodigos = $objServ->formatString($contacto__locacodigos);

			$contacto__contdirecios = $objServ->formatString($contacto__contdirecios);
			$contacto__conttelefons = $objServ->formatString($contacto__conttelefons);
			$contacto__contobservs = $objServ->formatString($contacto__contobservs);

			//Se valida si viene null
			if(!$contacto__contfecnacis)
				$contacto__contfecnacis = $sbdbnull;

			//Carga el servicio de customers
			$service = Application :: loadServices("Customers");
			$contacto_manager = $service->loadManager('ContactoManager');
			$message = $contacto_manager->addContacto($contacto__contindentis, $contacto__tiidcodigos,
			$contacto__cliecodigon, $contacto__contnombre, $contacto__contfecnacis, 
			$contacto__contsexos, $contacto__contemail, $contacto__locacodigos, 
			$contacto__contdirecios, $contacto__conttelefons, $contacto__contobservs);
			$service->close();
			if($message==15){
				$message=62;
			}
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}
?>