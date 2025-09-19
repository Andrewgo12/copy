<?php   
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCentroEmailPreview {
	function execute() {
		settype($rctmp, "array");
		settype($email_manager, "object");
		settype($serviceDate, "object");

		unset ($_REQUEST["emaiasuntos"]);
		unset ($_REQUEST["emaitextos"]);
		unset ($_REQUEST["emaiparas"]);
		unset ($_REQUEST["emaidesdes"]);
		unset ($_REQUEST["emaifecenvn"]);

		if ($_REQUEST["email__emaicodigos"]) {
			$serviceDate = Application :: loadServices("DateController");
			$email_manager = Application :: getDomainController('EmailManager');
			$rctmp = $email_manager->getByIdEmail($_REQUEST["email__emaicodigos"]);

			$_REQUEST["emaiasuntos"] = $rctmp[0]["emaiasuntos"];
			$_REQUEST["emaitextos"] = $rctmp[0]["emaitextos"];
			$_REQUEST["emaiparas"] = $rctmp[0]["emaiparas"];
			$_REQUEST["emaidesdes"] = $rctmp[0]["emaidesdes"];
			if ($rctmp[0]["emaifecenvn"]) {
				$_REQUEST["emaifecenvn"] = $serviceDate->fncformatofechahora($rctmp[0]["emaifecenvn"]);
			} else {
				$_REQUEST["emaifecenvn"] = "";
			}

			unset ($_REQUEST["email__emaicodigos"]);
		}
		return "success";
	}
}
?>	