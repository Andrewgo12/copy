<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdAddDiasInhabiles {

	function execute() 
	{
		extract($_REQUEST);
		$rcfechas = WebSession :: getProperty('rcfechas');
		
		$manager = Application::getDomainController('DiasInhabilesManager');
		$result = $manager->setDiasInhabiles($rcfechas);
		
		WebRequest::setProperty('cod_message', $result);
		WebSession :: unsetProperty("rcfechas");
		
		unset ($_REQUEST["nmonth"]);
		unset ($_REQUEST["nyear"]);
		unset ($_REQUEST["nday"]);
		unset ($_REQUEST["flag"]);
		unset ($_REQUEST["fecha"]);
		
		return "success";
	}
}
?>