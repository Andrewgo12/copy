<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdShowListPregunta {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");

		$objService = Application :: loadServices("Data_type");
		if ($pregunta__pregdescris)
		$_REQUEST["pregunta__pregdescris"] = $objService->formatString($pregunta__pregdescris);
			
		if(!WebSession::issetProperty("pregunta__pregcodigon"))
		WebSession::setProperty("pregunta__pregcodigon",$pregunta__pregcodigon);

		if(!WebSession::issetProperty("pregunta__morecodigon"))
		WebSession::setProperty("pregunta__morecodigon",$pregunta__morecodigon);

		if(!WebSession::issetProperty("pregunta__pregdescris"))
		WebSession::setProperty("pregunta__pregdescris",$pregunta__pregdescris);

		if(!WebSession::issetProperty("pregunta__temacodigon"))
		WebSession::setProperty("pregunta__temacodigon",$pregunta__temacodigon);
		
		if(!WebSession::issetProperty("pregunta__pregtipopres"))
		WebSession::setProperty("pregunta__pregtipopres",$pregunta__pregtipopres);
		
		if(!WebSession::issetProperty("pregunta__pregactivas"))
		WebSession::setProperty("pregunta__pregactivas",$pregunta__pregactivas);
		
		if(isset($_REQUEST["sqlConsult"])){
			$_REQUEST["sqlConsult"] = null;
		}

		return "success";
	}
}
?>