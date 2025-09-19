<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdConcepmovimi {
	function execute() {
		extract($_REQUEST);
		if (($concepmovimi__comocodigos != NULL) && ($concepmovimi__comocodigos != "")) {
			$concepmovimi_manager = Application :: getDomainController('ConcepmovimiManager');
			$concepmovimi_data = $concepmovimi_manager->getByIdConcepmovimi($concepmovimi__comocodigos);
			$_REQUEST["concepmovimi__comocodigos"] = $concepmovimi_data[0]["comocodigos"];
			$_REQUEST["concepmovimi__comonombres"] = $concepmovimi_data[0]["comonombres"];
			$_REQUEST["concepmovimi__comosentidos"] = $concepmovimi_data[0]["comosentidos"];
			$_REQUEST["concepmovimi__comodescrips"] = $concepmovimi_data[0]["comodescrips"];
			$_REQUEST["concepmovimi__comoactivas"] = $concepmovimi_data[0]["comoactivas"];
		} else {
			$_REQUEST["concepmovimi__comocodigos"] = WebSession :: getProperty("concepmovimi__comocodigos");
			$_REQUEST["concepmovimi__comonombres"] = WebSession :: getProperty("concepmovimi__comonombres");
			$_REQUEST["concepmovimi__comosentidos"] = WebSession :: getProperty("concepmovimi__comosentidos");
			$_REQUEST["concepmovimi__comodescrips"] = WebSession :: getProperty("concepmovimi__comodescrips");
			$_REQUEST["concepmovimi__comoactivas"] = WebSession :: getProperty("concepmovimi__comoactivas");
		}
		WebSession :: unsetProperty("concepmovimi__comocodigos");
		WebSession :: unsetProperty("concepmovimi__comonombres");
		WebSession :: unsetProperty("concepmovimi__comosentidos");
		WebSession :: unsetProperty("concepmovimi__comodescrips");
		WebSession :: unsetProperty("concepmovimi__comoactivas");
		return "success";
	}
}
?>	
