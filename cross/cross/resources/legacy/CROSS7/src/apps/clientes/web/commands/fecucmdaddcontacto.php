<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";

Class FeCuCmdAddContacto {

	function execute() {

		settype($rcLong,"array");
		settype($nuLong, "integer");
		settype($nuCantAnho, "integer");

		extract($_REQUEST);

		if (($contacto__contindentis != NULL) && ($contacto__contindentis != "")
		&& ($contacto__contprinoms != NULL) && ($contacto__contprinoms != "")
		&& ($contacto__contpriapes != NULL) && ($contacto__contpriapes != "")
		&& ($contacto__contsexos != NULL) && ($contacto__contsexos != "")
		&& ($contacto__tiidcodigos != NULL) && ($contacto__tiidcodigos != "")
		&& ($contacto__grincodigos != NULL) && ($contacto__grincodigos != "")) {

			$objServ = Application :: loadServices("Data_type");
			$sbdbnull = Application :: getConstant("DB_NULL");
			
			$rcLong["MIN_FNC"] = (int) Application :: getConstant("LON_MIN_FNC");
			$rcLong["MAX_FNC"] = (int) Application :: getConstant("LON_MAX_FNC");
			$rcLong["MIN_LNC"] = (int) Application :: getConstant("LON_MIN_LNC");
			$rcLong["MAX_LNC"] = (int) Application :: getConstant("LON_MAX_LNC");
			
			$nuLong = strlen(trim($contacto__contprinoms));
			if($rcLong["MAX_FNC"]<$nuLong || $rcLong["MIN_FNC"]>$nuLong){
				WebRequest::setProperty('cod_message',$message = 18);
				return "fail";
			}

			$nuLong = strlen(trim($contacto__contpriapes));
			if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
				WebRequest::setProperty('cod_message',$message = 20);
				return "fail";
			}

			if($contacto__contsegnoms){
				$contacto__contsegnoms = trim($contacto__contsegnoms);
				$nuLong = strlen(trim($contacto__contsegnoms));
				if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$message = 19);
					return "fail";
				}
			}
				
			if($contacto__contsegapes){
				$contacto__contsegapes = trim($contacto__contsegapes);
				$nuLong = strlen(trim($contacto__contsegapes));
				if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$message = 21);
					return "fail";
				}
			}

			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($contacto__contindentis) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			
			$serviceDate = Application :: loadServices("DateController");
			if ($contacto__contfecnacis != "") {
				if (!$serviceDate->fncvalidatedate($contacto__contfecnacis)) {
					WebRequest :: setProperty('cod_message', $message = 7);
					return "fail";
				}
			}
			
			//Se valida si viene null
			if($contacto__contfecnacis){
				$contacto__contedadn = $serviceDate->getYearsOld($contacto__contfecnacis);
				$contacto__contfecnacis = $serviceDate->fncdatetoint($contacto__contfecnacis);
			}else{
				$contacto__contfecnacis = $sbdbnull;	
			}

			$contacto__contindentis = $objServ->formatString($contacto__contindentis);
			$contacto__tiidcodigos = $objServ->formatString($contacto__tiidcodigos);
			$contacto__cliecodigon = $objServ->formatString($contacto__cliecodigos);
			$contacto__contprinoms = $objServ->formatString($contacto__contprinoms);
			$contacto__contsegnoms = $objServ->formatString($contacto__contsegnoms);
			$contacto__contpriapes = $objServ->formatString($contacto__contpriapes);
			$contacto__contsegapes = $objServ->formatString($contacto__contsegapes);
			$contacto__contnumcels = $objServ->formatString($contacto__contnumcels);
			$contacto__grincodigos = $objServ->formatString($contacto__grincodigos);
			
			if ($contacto__contemail) {
				if (!$objServ->IsEmail($contacto__contemail)) {
					WebRequest :: setProperty('cod_message', $message = 16);
					return "fail";
				}
			}
			
			if($contacto__contedadn){
				$nuCantAnho = (int) Application :: getConstant("CAN_MAX_EDAD");
				if($contacto__contedadn > $nuCantAnho){
					WebRequest :: setProperty('cod_message', $message = 22);
					return "fail";
				}
			}else{
				$contacto__contedadn = $sbdbnull;
			}
			
			//determina la localidad
			if ($contacto__locacodigos)
			$contacto__locacodigos = $objServ->formatString($contacto__locacodigos);

			$contacto__contdirecios = $objServ->formatString($contacto__contdirecios);
			$contacto__conttelefons = $objServ->formatString($contacto__conttelefons);
			$contacto__contobservs = $objServ->formatString($contacto__contobservs);

			$contacto_manager = Application :: getDomainController('ContactoManager');
			$message = $contacto_manager->addContacto($contacto__contindentis, $contacto__tiidcodigos,
			$contacto__cliecodigon, $contacto__contprinoms, $contacto__contsegnoms, $contacto__contpriapes, 
			$contacto__contsegapes, $contacto__contfecnacis, $contacto__contedadn, $contacto__contsexos, 
			$contacto__contemail, $contacto__locacodigos,$contacto__contdirecios, $contacto__conttelefons, 
			$contacto__contobservs,$contacto__contnumcels,$contacto__grincodigos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>