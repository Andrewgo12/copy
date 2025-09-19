<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeCuCmdUpdateCliente {
	function execute(){
		
		settype($rcLong,"array");
		settype($nuLong, "integer");
		
		extract($_REQUEST);
		if(($cliente__cliecodigos != NULL) && ($cliente__cliecodigos != "") &&
		($cliente__clieidentifs != NULL) && ($cliente__clieidentifs != "") &&
		($cliente__locacodigos != NULL) && ($cliente__locacodigos != "") &&
		($cliente__esclcodigos != NULL) && ($cliente__esclcodigos != "") &&
		($cliente__ticlcodigos != NULL) && ($cliente__ticlcodigos != "") &&
		($cliente__clienombres != NULL) && ($cliente__clienombres != "") &&
		($cliente__tiidcodigos != NULL) && ($cliente__tiidcodigos != "") &&
		($cliente__clielocalizs != NULL) && ($cliente__clielocalizs != "") &&
		($cliente__clietelefons != NULL) && ($cliente__clietelefons != "")){
			
			$objServ = Application::loadServices("Data_type");
			
			$rcLong["MIN_FNC"] = (int) Application :: getConstant("LON_MIN_FNC");
			$rcLong["MAX_FNC"] = (int) Application :: getConstant("LON_MAX_FNC");
			$rcLong["MIN_LNC"] = (int) Application :: getConstant("LON_MIN_LNC");
			$rcLong["MAX_LNC"] = (int) Application :: getConstant("LON_MAX_LNC");
			
			if($cliente__clierepprnos){
				$nuLong = strlen(trim($cliente__clierepprnos));
				if($rcLong["MAX_FNC"]<$nuLong || $rcLong["MIN_FNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$message = 18);
					return "fail";
				}	
			}
			
			if($cliente__cliereppraps){
				$nuLong = strlen(trim($cliente__cliereppraps));
				if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$message = 20);
					return "fail";
				}	
			}

			if($cliente__clierepsenos){
				$cliente__clierepsenos = trim($cliente__clierepsenos);
				$nuLong = strlen(trim($cliente__clierepsenos));
				if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$message = 19);
					return "fail";
				}
			}
				
			if($cliente__clierepseaps){
				$cliente__clierepseaps = trim($cliente__clierepseaps);
				$nuLong = strlen(trim($cliente__clierepseaps));
				if($rcLong["MAX_LNC"]<$nuLong || $rcLong["MIN_LNC"]>$nuLong){
					WebRequest::setProperty('cod_message',$message = 21);
					return "fail";
				}
			}
			
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($cliente__cliecodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}
			if($objServ->formatPrimaryKey($cliente__clieidentifs) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$cliente__clieidentifs = $objServ->formatString($cliente__clieidentifs);
			$cliente__ticlcodigos = $objServ->formatString($cliente__ticlcodigos);
			$cliente__clienombres = $objServ->formatString($cliente__clienombres);
			$cliente__clierepprnos = $objServ->formatString($cliente__clierepprnos);
			$cliente__clierepsenos = $objServ->formatString($cliente__clierepsenos);
			$cliente__cliereppraps = $objServ->formatString($cliente__cliereppraps);
			$cliente__clierepseaps = $objServ->formatString($cliente__clierepseaps);
			$cliente__clielocalizs = $objServ->formatString($cliente__clielocalizs);
			$cliente__clietelefons = $objServ->formatString($cliente__clietelefons);
			$cliente__locacodigos = $objServ->formatString($cliente__locacodigos);
			$cliente__cliepagwebs = $objServ->formatString($cliente__cliepagwebs);

			if($cliente__cliemails){
				if(!$objServ->IsEmail($cliente__cliemails)){
					WebRequest :: setProperty('cod_message', $message = 5);
					return "fail";
				}
			}

			$cliente__esclcodigos = $objServ->formatString($cliente__esclcodigos);
			$cliente__tiidcodigos = $objServ->formatString($cliente__tiidcodigos);
			$cliente__grclcodigos = $objServ->formatString($cliente__grclcodigos);
			$cliente__clienumfaxs = $objServ->formatString($cliente__clienumfaxs);
			$cliente__clieaparaers = $objServ->formatString($cliente__clieaparaers);
			$cliente_manager = Application::getDomainController('ClienteManager');
			$message = $cliente_manager->updateCliente($cliente__cliecodigos,$cliente__clieidentifs,$cliente__ticlcodigos,$cliente__clienombres,
			$cliente__clierepprnos, $cliente__clierepsenos, $cliente__cliereppraps, $cliente__clierepseaps,
			$cliente__clielocalizs,$cliente__clietelefons,$cliente__locacodigos,$cliente__cliepagwebs,$cliente__cliemails,
			$cliente__esclcodigos,$cliente__tiidcodigos,$cliente__grclcodigos,$cliente__clienumfaxs,$cliente__clieaparaers,
			$cliente__clieactivas);
			WebRequest::setProperty('cod_message', $message);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$message = 0);
			return "fail";
		}
	}
}
?>