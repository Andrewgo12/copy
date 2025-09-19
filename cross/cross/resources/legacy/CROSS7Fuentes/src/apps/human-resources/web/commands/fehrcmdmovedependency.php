<?php  
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdMoveDependency {
	function execute() {
		
		settype($serviceDate,"object");
		settype($sbmessage,"string");
		extract($_REQUEST);
		
		if (($orgacodigos != NULL) && ($orgacodigos != "")
		&& ($orgacgpads != NULL) && ($orgacgpads != "")) {
			
			$manager = Application::getDomainController("OrganizacionManager");
			$result = $manager->moveDependency($orgacodigos,$orgacgpads);
			
			if($result==true)
				$sbmessage=3;
			else
				$sbmessage=4;
			WebRequest :: setProperty('cod_message', $sbmessage);
			return "success";
		} 
		else {
			WebRequest :: setProperty('cod_message', $sbmessage = 0);
			return "fail";
		}
	}
}
?>