<?php  
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdUpdateGrupodetalle {
	function execute() {
		extract($_REQUEST);
		settype($rctmp, "array");
		settype($rcvalue, "array");
		settype($sbtmp, "string");
		settype($sbmessage, "string");
		settype($nucont, "integer");

		$sbtmp = "grupodetalle__perscodigos".$indice;
		$grupodetalle__perscodigos = $$sbtmp;
		$sbtmp = "grupodetalle__perscodigos".$indice."_desc";
		$grupodetalle__perscodigos_desc = $$sbtmp;
		$sbtmp = "grupodetalle__persrespons".$indice;
		$grupodetalle__persrespons = $$sbtmp;

		if (($grupodetalle__perscodigos != NULL) && ($grupodetalle__perscodigos != "") 
		&& ($grupodetalle__persrespons != NULL) && ($grupodetalle__persrespons != "")
		&& ($grupodetalle__perscodigos_desc != NULL) && ($grupodetalle__perscodigos_desc != "")) {

			$sbtmp = Application :: getConstant("GRUP_RESP");
			if (WebSession :: issetProperty("Grupodetalle")) {
				$rctmp = WebSession :: getProperty("Grupodetalle");
				if ($rctmp) {

					//se valida que el personal no este dos veces
					foreach ($rctmp as $nucont => $rcvalue) {
						if (($indice -1) != $nucont) {
							if ($rcvalue["perscodigos"] == $grupodetalle__perscodigos) {
								$sbmessage = 12;
								WebRequest :: setProperty('cod_message', $sbmessage);
								return "success";
							}
							if ($grupodetalle__persrespons == $sbtmp) {
								if ($rcvalue["persrespons"] == $sbtmp) {
									$sbmessage = 11;
									WebRequest :: setProperty('cod_message', $sbmessage);
									return "success";
								}
							}
						}
					}

					$rctmp[$indice -1]["perscodigos"] = $grupodetalle__perscodigos;
					$rctmp[$indice -1]["persnombres"] = $grupodetalle__perscodigos_desc;
					$rctmp[$indice -1]["persrespons"] = $grupodetalle__persrespons;
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