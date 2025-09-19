<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeCrCmdAddLlave {

	function execute() {
		extract($_REQUEST);

		settype($objService,"object");
		settype($objManager,"object");
		settype($objDate,"object");
		settype($rcMessage,"array");
		settype($sbDbnull,"string");
		settype($nuFechaini,"integer");
		settype($nuFechafin,"integer");
		settype($nuMessage,"integer");
		
		if (($llave__llavusuauts != NULL) && ($llave__llavusuauts != "")
		&& ($llave__llavususols != NULL) && ($llave__llavususols != "")
		&& ($llave__llavfecinid != NULL) && ($llave__llavfecinid != "")
		&& ($llave__llavfecvend != NULL) && ($llave__llavfecvend != "")
		&& ($llave__llavobservs != NULL) && ($llave__llavobservs != "")) {

			$sbDbnull = Application :: getConstant("DB_NULL");

			$objService = Application :: loadServices("Data_type");
				
			if ($objService->ValidateEmptyField($llave__llavobservs)) {
				WebRequest :: setProperty('cod_message', $nuMessage = 0);
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$llave__llavobservs = $objService->formatString($llave__llavobservs);

			//Servicio  de manipulacion de fechas
			$objDate = Application :: loadServices("DateController");

			if ($objDate->fncvalidatedate($llave__llavfecinid)) {
				$nuFechaini = $objDate->fncdatehourtoint($llave__llavfecinid);
			} else {
				WebRequest :: setProperty('cod_message', $nuMessage = 7);
				return "fail";
			}

			if ($objDate->fncvalidatedate($llave__llavfecvend)) {
				$nuFechafin = $objDate->fncdatehourtoint($llave__llavfecvend);
			} else {
				WebRequest :: setProperty('cod_message', $nuMessage = 7);
				return "fail";
			}
				
			//se valida que la fecha de inicio no sea mayor a la de vencimiento
			
			if($llave__llavfecinid > $llave__llavfecvend){
				WebRequest :: setProperty('cod_message', $nuMessage = 31);
				return "fail";
			}
			
			//se valida la existencia del personal
			if(!$this->existPersonal($llave__llavusuauts)){
				WebRequest :: setProperty('cod_message', $nuMessage = 66);
				return "fail";
			}
			
			if(!$this->existPersonal($llave__llavususols)){
				WebRequest :: setProperty('cod_message', $nuMessage = 67);
				return "fail";
			}
			

			$objManager = Application :: getDomainController('LlaveManager');
			$objManager->setData(array("llavusuauts"=>$llave__llavusuauts,
									   "llavususols"=>$llave__llavususols,
									   "llavfecinid"=>$nuFechaini,
									   "llavfecvend"=>$nuFechafin,
									   "llavobservs"=>$llave__llavobservs));

			$objManager->addLlave();
			$rcMessage = $objManager->getResult();
			
			if($rcMessage["result"]){
				WebRequest :: setProperty('cod_message', $nuMessage=68);
				$sbParams = $rcMessage["clave"].",".$llave__llavfecinid.",".$llave__llavfecvend;
				WebRequest :: setProperty('param', $sbParams);
				WebRequest :: setProperty('signal', $sbSignal = false);
				$objManager->UnsetRequest();
				return "success";
			}else{
				WebRequest :: setProperty('cod_message', $nuMessage = 100);
				return "fail";
			}
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
	
	function existPersonal($sbPerscodigos){
		
		settype($objService,"object");
		settype($rcTmp,"array");
		settype($sbEstate,"string");
		
		if($sbPerscodigos!="" && $sbPerscodigos!=null){
			
			$objService = Application::loadServices("Human_resources");
			$rcTmp =  $objService->getPersonal($sbPerscodigos);
			
			if(is_array($rcTmp) && $rcTmp){
				$rcTmp = $rcTmp[0];
				$sbEstate = Application :: getConstant("REG_ACT");
				if($rcTmp["persestadoc"] == $sbEstate){
					return true;
				}
			}
		}
		
		return false;
	}

}
?>