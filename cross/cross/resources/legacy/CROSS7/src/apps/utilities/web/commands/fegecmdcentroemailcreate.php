<?php   
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCentroEmailCreate {
	function execute() {
		extract($_REQUEST);
		settype($email_manager, "object");
		settype($objCentroEmail, "object");
		settype($orden_manager, "object");
		settype($sbResult, "string");
		settype($sbClose, "string");

		//SI limpia el $_REQUEST
		if ($clean_table) {
			$email_manager = Application :: getDomainController("EmailManager");
			$email_manager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		if (!$instance) {

			if ($ordenumeros) {

				$orden_manager = Application :: loadServices("Cross300");
				$sbResult = $orden_manager->fncValidateExistenceOrder($ordenumeros);

				if ($sbResult) {
					$_REQUEST["email__ordenumeros"] = $ordenumeros;

					if ($foemcodigos) {

						$objCentroEmail = Application :: getDomainController('CentroEmailManager');
						$rcTmp = $objCentroEmail->fncCreateEmail($ordenumeros, $foemcodigos);
						if ($rcTmp["result"] == 52) {

							$_REQUEST["email__emaiasuntos"] = $rcTmp["asunto"];
							$_REQUEST["email__emaitextos"] = $rcTmp["texto"];
							$_REQUEST["email__foemcodigos"] = $foemcodigos;
						}
						$sbmessage = $rcTmp["result"];
					}
				}else{
					$sbmessage = 53;
					$sbClose = true;
					WebRequest :: setProperty('param', $ordenumeros);
				}
			}
		}
		WebRequest :: setProperty('close', $sbClose);
		WebRequest :: setProperty('cod_message', $sbmessage);
		return "success";
	}
}
?>