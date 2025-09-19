<?php  
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowOrgHasOpenCases {
	function execute() {
		
		settype($objDate,"object");
		settype($objService,"object");
		settype($objmanagerDF, "object");
		settype($rcData,"array");
		settype($rcDataP, "array");
		settype($rcPhisical, "array");
		settype($rcTareas, "array");
		settype($sbMessage,"string");
		settype($sbResult,"string");
		extract($_REQUEST);
		
		//al colocar la validacion del padre implica que no se pude colocar el nodo en el tope de la jerarquia.
		
		if (($organizacion__orgacodigos != NULL) && ($organizacion__orgacodigos != "")
			&& $organizacion__orgacgpads!=NULL && $organizacion__orgacgpads!="") {
			
			$objManager = Application::getDomainController("OrganizacionManager");
			$rcData = $objManager->getByIdOrganizacion($organizacion__orgacodigos);
			
			if(is_array($rcData) && $rcData){
				$rcData = $rcData[0];
			}
			
			if($rcData["orgacgpads"] == $organizacion__orgacgpads) {
				WebRequest :: setProperty('cod_message', $sbMessage = 24);
				return "fail";
			}

			$objService = Application::loadServices('General');
        	$rcPhisical = $objService->getParam("human_resources","TIP_DEP_FISICA");
			
			if(!is_array($rcPhisical) || !$rcPhisical){
				WebRequest :: setProperty('cod_message', $sbMessage = 26);
				return "fail";
			}

			if(in_array($rcData["tiorcodigos"],$rcPhisical)) {
				WebRequest :: setProperty('cod_message', $sbMessage = 22);
				return "fail";
			}
			
			//informacion del nuevo ente padre
			$objManager = Application::getDomainController("OrganizacionManager");
			$rcDataP = $objManager->getByIdOrganizacion($organizacion__orgacgpads);
			
			if(is_array($rcDataP) && $rcDataP){
				$rcDataP = $rcDataP[0];
			}
			

			if(!in_array($rcDataP["tiorcodigos"],$rcPhisical)) {
				WebRequest :: setProperty('cod_message', $sbMessage = 23);
				return "fail";
			}

			$objService = Application :: loadServices("Workflow");
			$rcTareas = $objService->getAsignWork($organizacion__orgacodigos);
			
			if(is_array($rcTareas) && $rcTareas) {
				WebRequest :: setProperty('cod_message', $sbMessage=21);
				return "fail";
			}else {
				//PROCEDAMOS A MOVER
				if (($organizacion__orgacgpads == NULL) || ($organizacion__orgacgpads == "")) {
					WebRequest :: setProperty('cod_message', $sbMessage = 0);
					return "fail";
				}
				$sbResult = $objManager->moveDependency($organizacion__orgacodigos,$organizacion__orgacgpads);

				if($sbResult==true){
					$sbMessage=3;
				}else{
					$sbMessage=4;	
				}
				WebRequest :: setProperty('cod_message', $sbMessage);
				return "success";
			}
		} 
		else {
			WebRequest :: setProperty('cod_message', $sbMessage = 0);
			return "fail";
		}
	}
}
?>