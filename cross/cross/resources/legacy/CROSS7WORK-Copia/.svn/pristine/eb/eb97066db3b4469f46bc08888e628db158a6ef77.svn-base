<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeGeCmdShowByIdEquivalencias {
	function execute(){
		
		settype($objManager,"object");
		settype($objService,"object");
		settype($rcData,"array");
		settype($rcTmp,"array");
		
		extract($_REQUEST);
		if(($equivalencias__equicodigon != NULL) && ($equivalencias__equicodigon != "")){
			
			$objManager = Application::getDomainController('EquivalenciasManager');
			
			$objManager->setData(array("equicodigon"=>$equivalencias__equicodigon));
			$objManager->getByIdEquivalencias();
			$rcData = $objManager->getResult();
			
			$_REQUEST["equivalencias__equicodigon"] = $rcData[0]["equicodigon"];
			$_REQUEST["equivalencias__equitablcros"] = $rcData[0]["equitablcros"];
			$_REQUEST["equivalencias__equicampcros"] = $rcData[0]["equicampcros"];
			$_REQUEST["equivalencias__equivalcros"] = $rcData[0]["equivalcros"];
			$_REQUEST["equivalencias__equinomcros"] = $rcData[0]["equinomcros"];
			$_REQUEST["equivalencias__equitabldocs"] = $rcData[0]["equitabldocs"];
			$_REQUEST["equivalencias__equicampdocs"] = $rcData[0]["equicampdocs"];
			$_REQUEST["equivalencias__equivaldocs"] = $rcData[0]["equivaldocs"];
			$_REQUEST["equivalencias__equinomdocs"] = $rcData[0]["equinomdocs"];
			$_REQUEST["equivalencias__equifechacrn"] = $rcData[0]["equifechacrn"];
			$_REQUEST["equivalencias__equiestados"] = $rcData[0]["equiestados"];
			$_REQUEST["equivalencias__equiareacros"] = $rcData[0]["equiareacros"];
			if($rcData[0]["equiareacros"]){
				//se obtiene el label
				$objService = Application::loadServices("Human_resources");
				$rcTmp = $objService->getDataEntesOrg($rcData[0]["equiareacros"],true);
				if(is_array($rcTmp) && $rcTmp){
					//equivalencias__equiareacros
					$_REQUEST["equiareacros_desc"] = $rcTmp["nombre"];
				}
			}
			$_REQUEST["equivalencias__equiareadocs"] = $rcData[0]["equiareadocs"];
			$_REQUEST["equivalencias__equiseridocs"] = $rcData[0]["equiseridocs"];
		}else{
			$_REQUEST["equivalencias__equicodigon"] = WebSession::getProperty("equivalencias__equicodigon");
			$_REQUEST["equivalencias__equitablcros"] = WebSession::getProperty("equivalencias__equitablcros");
			$_REQUEST["equivalencias__equicampcros"] = WebSession::getProperty("equivalencias__equicampcros");
			$_REQUEST["equivalencias__equivalcros"] = WebSession::getProperty("equivalencias__equivalcros");
			$_REQUEST["equivalencias__equinomcros"] = WebSession::getProperty("equivalencias__equinomcros");
			$_REQUEST["equivalencias__equitabldocs"] = WebSession::getProperty("equivalencias__equitabldocs");
			$_REQUEST["equivalencias__equicampdocs"] = WebSession::getProperty("equivalencias__equicampdocs");
			$_REQUEST["equivalencias__equivaldocs"] = WebSession::getProperty("equivalencias__equivaldocs");
			$_REQUEST["equivalencias__equinomdocs"] = WebSession::getProperty("equivalencias__equinomdocs");
			$_REQUEST["equivalencias__equifechacrn"] = WebSession::getProperty("equivalencias__equifechacrn");
			$_REQUEST["equivalencias__equiestados"] = WebSession::getProperty("equivalencias__equiestados");
			$_REQUEST["equivalencias__equiareacros"] = WebSession::getProperty("equivalencias__equiareacros");
			$_REQUEST["equivalencias__equiareacros"] = WebSession::getProperty("equiareacros_desc");
			$_REQUEST["equivalencias__equiareadocs"] = WebSession::getProperty("equivalencias__equiareadocs");
			$_REQUEST["equivalencias__equiseridocs"] = WebSession::getProperty("equivalencias__equiseridocs");
		}
		WebSession::unsetProperty("equivalencias__equicodigon");
		WebSession::unsetProperty("equivalencias__equitablcros");
		WebSession::unsetProperty("equivalencias__equicampcros");
		WebSession::unsetProperty("equivalencias__equivalcros");
		WebSession::unsetProperty("equivalencias__equinomcros");
		WebSession::unsetProperty("equivalencias__equitabldocs");
		WebSession::unsetProperty("equivalencias__equicampdocs");
		WebSession::unsetProperty("equivalencias__equivaldocs");
		WebSession::unsetProperty("equivalencias__equinomdocs");
		WebSession::unsetProperty("equivalencias__equifechacrn");
		WebSession::unsetProperty("equivalencias__equiestados");	
		WebSession::unsetProperty("equivalencias__equiareacros");
		WebSession::unsetProperty("equiareacros_desc");
		WebSession::unsetProperty("equivalencias__equiareadocs");
		WebSession::unsetProperty("equivalencias__equiseridocs");
		return "success";
	}
}
?>