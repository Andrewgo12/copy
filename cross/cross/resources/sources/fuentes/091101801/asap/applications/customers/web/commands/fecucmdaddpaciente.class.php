<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";

Class FeCuCmdAddPaciente {

	function execute() {

		settype($objDate, "object");
		settype($objServ, "object");
		settype($objManager, "object");
		settype($rcLong,"array");
		settype($nuLong, "integer");
		settype($nuCantAnho, "integer");
		settype($nuMessage, "integer");

		extract($_REQUEST);

		if (($paciente__paciindentis != NULL) && ($paciente__paciindentis != "")
		&& ($paciente__paciprinoms != NULL) && ($paciente__paciprinoms != "")
		&& ($paciente__pacipriapes != NULL) && ($paciente__pacipriapes != "")
		&& ($paciente__sexocodigos != NULL) && ($paciente__sexocodigos != "")
		&& ($paciente__tiidcodigos != NULL) && ($paciente__tiidcodigos != "")) {

			$objServ = Application :: loadServices("Data_type");
			$sbdbnull = Application :: getConstant("DB_NULL");
			
			$rcLong["MIN_FNC"] = (int) Application :: getConstant("LON_MIN_FNC");
			$rcLong["MAX_FNC"] = (int) Application :: getConstant("LON_MAX_FNC");
			$rcLong["MIN_LNC"] = (int) Application :: getConstant("LON_MIN_LNC");
			$rcLong["MAX_LNC"] = (int) Application :: getConstant("LON_MAX_LNC");
			
			$nuLong = strlen(trim($paciente__paciprinoms));
			if($rcLong["MAX_FNC"]<$nuLong || $rcLong["MIN_FNC"]>$nuLong){
				WebRequest::setProperty('cod_message',$nuMessage = 18);
				return "fail";
			}

			$nuLong = strlen(trim($paciente__pacipriapes));
			if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
				WebRequest::setProperty('cod_message',$nuMessage = 20);
				return "fail";
			}

			if($paciente__pacisegnoms){
				$paciente__pacisegnoms = trim($paciente__pacisegnoms);
				$nuLong = strlen(trim($paciente__pacisegnoms));
				if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$nuMessage = 19);
					return "fail";
				}
			}
				
			if($paciente__pacisegapes){
				$paciente__pacisegapes = trim($paciente__pacisegapes);
				$nuLong = strlen(trim($paciente__pacisegapes));
				if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$nuMessage = 21);
					return "fail";
				}
			}

			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($paciente__paciindentis) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}
			
			$objDate = Application :: loadServices("DateController");
			if ($paciente__pacifecnacis != "") {
				if (!$objDate->fncvalidatedate($paciente__pacifecnacis)) {
					WebRequest :: setProperty('cod_message', $nuMessage = 7);
					return "fail";
				}
			}
			
			//Se valida si viene null
			if($paciente__pacifecnacis){
				
				if($contacto==1){
					$contacto__contedadn = $objDate->getYearsOld($paciente__pacifecnacis);	
				}
				$paciente__pacifecnacis = $objDate->fncdatetoint($paciente__pacifecnacis);
			}else{
				$paciente__pacifecnacis = $sbdbnull;	
			}

			$paciente__paciindentis = $objServ->formatString($paciente__paciindentis);
			$paciente__tiidcodigos = $objServ->formatString($paciente__tiidcodigos);
			$paciente__paciprinoms = $objServ->formatString($paciente__paciprinoms);
			$paciente__pacisegnoms = $objServ->formatString($paciente__pacisegnoms);
			$paciente__pacipriapes = $objServ->formatString($paciente__pacipriapes);
			$paciente__pacisegapes = $objServ->formatString($paciente__pacisegapes);
			$paciente__pacinumcels = $objServ->formatString($paciente__pacinumcels);
			
			if ($paciente__paciemail) {
				if (!$objServ->IsEmail($paciente__paciemail)) {
					WebRequest :: setProperty('cod_message', $nuMessage = 16);
					return "fail";
				}
			}
			
			//determina la localidad
			if ($paciente__locacodigos)
			$paciente__locacodigos = $objServ->formatString($paciente__locacodigos);

			$paciente__pacidirecios = $objServ->formatString($paciente__pacidirecios);
			$paciente__pacitelefons = $objServ->formatString($paciente__pacitelefons);
			$paciente__paciobservs = $objServ->formatString($paciente__paciobservs);
			$paciente__pacihisclis = $objServ->formatString($paciente__pacihisclis);

			$objManager = Application :: getDomainController('PacienteManager');
			$nuMessage = $objManager->addPaciente($paciente__paciindentis, $paciente__tiidcodigos,
			$paciente__paciprinoms, $paciente__pacisegnoms, $paciente__pacipriapes, 
			$paciente__pacisegapes, $paciente__pacifecnacis, $paciente__sexocodigos, $paciente__paciemail, $paciente__locacodigos,
			$paciente__pacidirecios, $paciente__pacitelefons, $paciente__pacihisclis, $paciente__paciobservs, $paciente__pacinumcels);
			
			//grabar el paciente como contacto
			if($nuMessage==3 && $contacto==1){
				
				if($contacto__contedadn){
					$nuCantAnho = (int) Application :: getConstant("CAN_MAX_EDAD");
					if($contacto__contedadn > $nuCantAnho){
						WebRequest :: setProperty('cod_message', $nuMessage = 36);
						return "success";
					}
				}else{
					$contacto__contedadn = $sbdbnull;
				}
				
				$objManager = Application :: getDomainController('ContactoManager');
				$nuMessage = $objManager->addContacto($paciente__paciindentis, $paciente__tiidcodigos,
				NULL, $paciente__paciprinoms, $paciente__pacisegnoms, $paciente__pacipriapes, 
				$paciente__pacisegapes, $paciente__pacifecnacis, $contacto__contedadn, $paciente__sexocodigos, $paciente__paciemail, $paciente__locacodigos,
				$paciente__pacidirecios, $paciente__pacitelefons, $paciente__paciobservs,$paciente__pacinumcels);
			}
			
			if($nuMessage!=3 && $contacto==1){
				$nuMessage = 36;
			}
			
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>
