<?php           
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdAddGrupodetalle {
	function execute() {

		extract($_REQUEST);
		settype($rctmp, "array");
		settype($sbtmp, "string");
		settype($sbmessage, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");

		if (($grupodetalle__perscodigos != NULL) && ($grupodetalle__perscodigos != "") 
		&& ($grupodetalle__persrespons != NULL) && ($grupodetalle__persrespons != "")) {
			$sbtmp = Application :: getConstant("GRUP_RESP");
			if (!(WebSession :: issetProperty("Grupodetalle"))) {
				$rctmp[0]["perscodigos"] = $grupodetalle__perscodigos;
				$rctmp[0]["persrespons"] = $grupodetalle__persrespons;
				$rctmp[0]["persnombres"] = $grupodetalle__perscodigos_desc;

				WebSession :: setProperty("Grupodetalle", $rctmp);
			} else {
				$rctmp = WebSession :: getProperty("Grupodetalle");
				if ($rctmp) {

					$nucant = sizeof($rctmp);
					//si ya existen datos se valida que no haya 2 responsables
					for ($nucont = 0; $nucont < $nucant; $nucont ++) {
						if ($rctmp[$nucont]["perscodigos"] == $grupodetalle__perscodigos) {
							$sbmessage = 12;
							WebRequest :: setProperty('cod_message', $sbmessage);
							return "success";
						}
						if ($grupodetalle__persrespons == $sbtmp) {
							if ($rctmp[$nucont]["persrespons"] == $sbtmp) {
								$sbmessage = 11;
								WebRequest :: setProperty('cod_message', $sbmessage);
								return "success";
							}
						}
					}
					
					$rctmp[$nucant]["perscodigos"] = $grupodetalle__perscodigos;
					$rctmp[$nucant]["persrespons"] = $grupodetalle__persrespons;
					$rctmp[$nucant]["persnombres"] = $grupodetalle__perscodigos_desc;
					
					WebSession :: setProperty("Grupodetalle", $rctmp);
				} else {
					$rctmp[0]["perscodigos"] = $grupodetalle__perscodigos;
					$rctmp[0]["persrespons"] = $grupodetalle__persrespons;
					$rctmp[0]["persnombres"] = $grupodetalle__perscodigos_desc;
					WebSession :: setProperty("Grupodetalle", $rctmp);
				}
			}
			//$sbmessage = 3;
			//WebRequest :: setProperty('cod_message', $sbmessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 0);
			return "fail";
		}
	}
}
?>	