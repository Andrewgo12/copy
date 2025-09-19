<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdShowListProceso {

	function execute() {
		settype($serviceDate, "object");
		settype($objService, "object");
		extract($_REQUEST);
		$serviceDate = Application :: loadServices("DateController");
		
		$objService = Application :: loadServices("Data_type");
		if($proceso__procnombres){
			$_REQUEST["proceso__procnombres"] = $objService->formatString($proceso__procnombres);
		}
		if($proceso__procdescris){
			$_REQUEST["proceso__procdescris"] = $objService->formatString($proceso__procdescris);
		}

		if (!WebSession :: issetProperty("proceso__proccodigos"))
			WebSession :: setProperty("proceso__proccodigos", $proceso__proccodigos);

		if (!WebSession :: issetProperty("proceso__procnombres"))
			WebSession :: setProperty("proceso__procnombres", $proceso__procnombres);

		if (!WebSession :: issetProperty("proceso__procdescris"))
			WebSession :: setProperty("proceso__procdescris", $proceso__procdescris);

		if (!WebSession :: issetProperty("proceso__perscodigos"))
			WebSession :: setProperty("proceso__perscodigos", $proceso__perscodigos);

		if (!WebSession :: issetProperty("proceso__procestinis"))
			WebSession :: setProperty("proceso__procestinis", $proceso__procestinis);

		if (!WebSession :: issetProperty("proceso__procestfins"))
			WebSession :: setProperty("proceso__procestfins", $proceso__procestfins);
			
		if ($proceso__procfeccren) {
			$proceso__procfeccren = $serviceDate->fncdatehourtoint($proceso__procfeccren);
			$_REQUEST["proceso__procfeccren"] = $proceso__procfeccren;
		}

		if (!WebSession :: issetProperty("proceso__procfeccren")) {
			if($proceso__procfeccren){
				WebSession :: setProperty("proceso__procfeccren", $proceso__procfeccren);
			}
		}

		if (!WebSession :: issetProperty("proceso__orgacodigos"))
			WebSession :: setProperty("proceso__orgacodigos", $proceso__orgacodigos);
			
		if($proceso__proctiempon){
			$proceso__proctiempon = $proceso__proctiempon * 86400; 
		}else{
			$proceso__proctiempon = 0;
		}
		
		if($horas){
            $horas = $horas * 3600;
			$proceso__proctiempon += $horas; 
            $_REQUEST["horas"] = $horas;
		}else{
            $horas = 0;
            $_REQUEST["horas"] = $horas;
        }

		if (!WebSession :: issetProperty("proceso__proctiempon"))
			WebSession :: setProperty("proceso__proctiempon", $proceso__proctiempon);
            
		if (!WebSession :: issetProperty("horas"))
			WebSession :: setProperty("horas", $horas);
			
		if($proceso__proctiempon){
			$_REQUEST["proceso__proctiempon"] = $proceso__proctiempon;
		}

		if (!WebSession :: issetProperty("tiorcodigos"))
			WebSession :: setProperty("tiorcodigos", $tiorcodigos);
		if (!WebSession :: issetProperty("evencodigos"))
			WebSession :: setProperty("evencodigos", $evencodigos);
		if (!WebSession :: issetProperty("causcodigos"))
			WebSession :: setProperty("causcodigos", $causcodigos);

		if (!WebSession :: issetProperty("proceso__procactivas"))
			WebSession :: setProperty("proceso__procactivas", $proceso__procactivas);

		return "success";
	}
}
?>	