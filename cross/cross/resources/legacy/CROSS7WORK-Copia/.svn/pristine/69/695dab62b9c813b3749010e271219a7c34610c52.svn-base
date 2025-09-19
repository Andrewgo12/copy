<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdUpdateProceso {

	function execute() {
		
		settype($serviceDate, "object");
		settype($_RQUESTTPM, "array");
		settype($sbmessage, "string");
		settype($proceso__perscodigos,"string");
		settype($proceso__procestinis,"string");
		settype($proceso__procestfins,"string");
		$_RQUESTTPM = $_REQUEST;
		extract($_REQUEST);

		if (($proceso__proccodigos != NULL) && ($proceso__proccodigos != "")) {
            if(($proceso__procnombres != NULL) && ($proceso__procnombres != "") &&
                ($proceso__orgacodigos != NULL) && ($proceso__orgacodigos != "") &&
                ($tiorcodigos != NULL) && ($tiorcodigos != "") &&
			((($proceso__proctiempon != NULL) && ($proceso__proctiempon != "") && ($proceso__proctiempon != 0))||
			(($horas != NULL) && ($horas != "") && ($horas != 0))))
			{
                $objServ = Application :: loadServices("Data_type");
                //Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
                if ($objServ->formatPrimaryKey($proceso__proccodigos) == false) {
                    WebRequest :: setProperty('cod_message', $sbmessage = 4);
                    return "fail";
                }
                //Hace la validacion de campos numericos y formateo de campos cadena
                $proceso__procnombres = $objServ->formatString($proceso__procnombres);
                $proceso__procdescris = $objServ->formatString($proceso__procdescris);
                $proceso__perscodigos = $objServ->formatString($proceso__perscodigos);
                $proceso__procestinis = $objServ->formatString($proceso__procestinis);
                $proceso__procestfins = $objServ->formatString($proceso__procestfins);
                $proceso__orgacodigos = $objServ->formatString($proceso__orgacodigos);
                if ($proceso__proctiempon) {
                    //valida el tipo de dato
                    if(!$objServ->isInteger($proceso__proctiempon)){
                        WebRequest :: setProperty('cod_message', $sbmessage = 4);
                        return "fail";
                    }
                    //Pasado cantidad de dias a segundos
                    $proceso__proctiempon = $proceso__proctiempon * 86400;
                } else {
                    $proceso__proctiempon = 0;
                }
                if ($horas) {
                    //valida el tipo de dato
                    if(!$objServ->isInteger($horas)){
                        WebRequest :: setProperty('cod_message', $sbmessage = 4);
                        return "fail";
                    }
                    if($horas >= 0 && $horas <= 23){
                        $proceso__proctiempon += ($horas * 3600);
                    }else{
                        WebRequest :: setProperty('cod_message', $sbmessage = 6);
                        return "fail";
                    }
                }
                //Servicio  de manipulacion de fechas
                $serviceDate = Application :: loadServices("DateController");
                if ($proceso__procfeccren == "") {
                    $proceso__procfeccren = "NULL";
                } else {
                    if ($serviceDate->fncvalidatedate($proceso__procfeccren)) {
                        $proceso__procfeccren = $serviceDate->fncdatehourtoint($proceso__procfeccren);
                    } else {
                        WebRequest :: setProperty('cod_message', $sbmessage = 4);
                        return "fail";
                    }
                }
                $rcConfig[1] = array('=',$tiorcodigos);
				$rcConfig[2] = array('=',$evencodigos);
				$rcConfig[3] = array('=',$causcodigos);
                
                $proceso_manager = Application :: getDomainController('ProcesoManager');
                $sbmessage = $proceso_manager->updateProceso($proceso__proccodigos, $proceso__procnombres, 
                $proceso__procdescris, $proceso__perscodigos, $proceso__procestinis, $proceso__procestfins, 
                $proceso__procfeccren, $proceso__orgacodigos, $proceso__proctiempon, $proceso__procactivas, $rcConfig);
                WebRequest :: setProperty('cod_message', $sbmessage);
                if ($sbmessage == 3) {
                    WebRequest :: setProperty('cod_message', $sbmessage);
                    return "success";
                } else {
                    $_REQUEST = $_RQUESTTPM;
                    WebRequest :: setProperty('cod_message', $sbmessage);
                    return "fail";
                }
            } else {
                WebRequest :: setProperty('cod_message', $sbmessage = 0);
                return "fail";
            }
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 7);
			return "fail";
		}
	}
}
?>	