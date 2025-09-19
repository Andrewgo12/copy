<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";

Class FeEnCmdShowListFormulario {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");
		settype($objDate,"object");

		$objService = Application :: loadServices("Data_type");
		$objDate = Application::loadServices("DateController");
		if ($formulario__formnombres){
			$_REQUEST["formulario__formnombres"] = $objService->formatString($formulario__formnombres);	
		}
		
		if ($formulario__formintrodus){
			$_REQUEST["formulario__formintrodus"] = $objService->formatString($formulario__formintrodus);	
		}
		
		if ($formulario__formfeccrean){
			$_REQUEST["formulario__formfeccrean"] = $objDate->fncdatehourtoint($formulario__formfeccrean);	
		}
		
		if(!WebSession::issetProperty("formulario__formcodigon"))
		WebSession::setProperty("formulario__formcodigon",$formulario__formcodigon);

		if(!WebSession::issetProperty("formulario__formnombres"))
		WebSession::setProperty("formulario__formnombres",$formulario__formnombres);

		if(!WebSession::issetProperty("formulario__formfeccrean"))
		WebSession::setProperty("formulario__formfeccrean",$formulario__formfeccrean);

		if(!WebSession::issetProperty("formulario__formintrodus"))
		WebSession::setProperty("formulario__formintrodus",$formulario__formintrodus);
		
		if(!WebSession::issetProperty("formulario__formpredets"))
		WebSession::setProperty("formulario__formpredets",$formulario__formpredets);
		
		if(!WebSession::issetProperty("formulario__formactivos"))
		WebSession::setProperty("formulario__formactivos",$formulario__formactivos);
		
		if(isset($_REQUEST["sqlConsult"])){
			$_REQUEST["sqlConsult"] = null;
		}

		return "success";
	}
}
?>