<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteMovimialmace {
	function execute() {
		$genericData = WebSession :: getProperty("genericData");
		extract($_REQUEST);
		if ($serial == "") {
			//Elimina un registro completo
			foreach ($genericData as $key => $rcReg) {
				if ($key != $registro)
					$rcNew[] = $rcReg;
			}
			WebSession :: setProperty("genericData", $rcNew);
		} else {
			foreach($genericData[$registro]["series"] as $key => $rcTmp){
				if($serial != $key){
					$rcNew[] = $rcTmp;
				}else{
					$rcRegElim = $rcTmp;
				}					
			}
			//Actualiza el saldo total
			$genericData[$registro]["moalcantrecf"] = $genericData[$registro]["moalcantrecf"] - (($rcRegElim["serial2"] - $rcRegElim["serial1"]) + 1);
			$genericData[$registro]["series"] = $rcNew;
			WebSession :: setProperty("genericData", $genericData);
		}
		WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
		return "success";
	}
}
?>	
