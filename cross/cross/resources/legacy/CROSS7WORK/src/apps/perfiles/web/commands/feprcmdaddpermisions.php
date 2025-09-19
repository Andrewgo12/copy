<?php   
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FePrCmdAddPermisions {
	function execute() {
		extract($_REQUEST);
		if (($profcodigos != NULL) && ($profcodigos != "") 
         && ($schecodigon != NULL) && ($schecodigon != "")
         && ($applcodigos != NULL) && ($applcodigos != "")) {
			//Genera los sql y los inserta
			if ($selected_opt != "")
				$rcCom = explode(",", $selected_opt);
			else
				$rcCom = array ();
			//Crea el archivo xml del perfil
			$xmlProfileManager = Application::getDomainController('XmlProfileManager');
			
			$nuXml = $schecodigon."_".$profcodigos;
			$result =  $xmlProfileManager->xmlFile($nuXml,$rcCom);
			if($result == false){
				WebRequest :: setProperty('cod_message', $message = 45);
				return "fail";
			}
			//Filtra los comandos
			$nuCont = 0; 
			foreach($rcCom as $sbtmp){
				$rcTmp = explode("|",$sbtmp);
				if($rcTmp[3] == "form" || $rcTmp[3] == "button"){
					$rcCommands[$nuCont] = $rcTmp[0];
					$nuCont++;
				}
			}
			
			$permisions_manager = Application::getDomainController('PermisionsManager'); 
			$sbResult = $permisions_manager->genSqlAdd($profcodigos, $applcodigos, $rcCommands,$schecodigon);
			
			if ($sbResult == false) {
				//Elimina el archivo XML
				$xmlProfileManager->unsetXmlProfile($nuXml);
				WebRequest :: setProperty('cod_message', $message = 100);
				return "fail";
			}
			WebRequest :: setProperty('cod_message', $message = 3);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	
