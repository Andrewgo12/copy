<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeGeCmdDefaultIntelogdoc {
	function execute(){
		
		settype($objManager,"object");
		settype($rcTmp,"array");
		
		extract($_REQUEST);
		//Se carga el $_REQUEST
		if(isset($inlocodigon) && $inlocodigon){
			$objManager = Application::getDomainController("IntegraLogManager");
			$objManager->setData(array("inlocodigon"=>$inlocodigon));
			$objManager->getIntelogdoc();
			$rcTmp = $objManager->getResult();
			
			if(is_array($rcTmp["data"]) && $rcTmp["data"]){
				$rcTmp = $rcTmp["data"][0];
				$_REQUEST['intelogdoc__inlocodigon'] =  $rcTmp["inlocodigon"];
				$_REQUEST['intelogdoc__nmbre_srie'] =  $rcTmp["nmbre_srie"];
				$_REQUEST['intelogdoc__nmbre_tpo_crpta'] =  $rcTmp["nmbre_tpo_crpta"];
				$_REQUEST['intelogdoc__nmbre_crpta'] =  $rcTmp["nmbre_crpta"];
				$_REQUEST['intelogdoc__nmbre_tpo_dcto'] =  $rcTmp["nmbre_tpo_dcto"];
				$_REQUEST['intelogdoc__nmbre_dcto'] =  $rcTmp["nmbre_dcto"];
				$_REQUEST['intelogdoc__ext'] =  $rcTmp["ext"];
				$_REQUEST['intelogdoc__fncnrio'] =  $rcTmp["fncnrio"];
				$_REQUEST['intelogdoc__d_id_cross'] =  $rcTmp["d_id_cross"];
			}else{
				WebRequest::setProperty('cod_message',$rcTmp["message"]);
				return "fail";
			}
		}
		return "success";
	}
}
?>