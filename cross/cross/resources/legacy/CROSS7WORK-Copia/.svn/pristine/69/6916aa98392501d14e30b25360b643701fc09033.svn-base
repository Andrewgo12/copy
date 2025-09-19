<?php   
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdAddPhysicaldependencies {
	function execute() {
		extract($_REQUEST);
		
		settype($objManager,"object");
		settype($rcTmp,"array");
		settype($nuMessage,"integer");
		
		if (($orgacodigos != NULL) 
		&& ($orgacodigos != "")){
			
			//Arma el vector a almacenar
			if($selected_opt){
				$rcTmp = explode(",",$selected_opt);
			}
					
			$objManager = Application::getDomainController('PhysicaldependenciesManager'); 
			$nuMessage = $objManager->updatePhysicaldependencies($orgacodigos, $rcTmp);
			
			
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>