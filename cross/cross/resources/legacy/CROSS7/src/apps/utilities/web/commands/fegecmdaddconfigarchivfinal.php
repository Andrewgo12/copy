<?php       
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdAddConfigarchivFinal {
	function execute() {
		extract($_REQUEST);
		settype($objServ, "object");
		settype($configarchiv_manager, "object");
		settype($rcconfigarchiv, "array");
		settype($rcdetaconfarch, "array");
		settype($rcresultc, "array");
		settype($rcresultd, "array");
		settype($sbmessage, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");
		if (WebSession :: issetProperty("Configarchiv") && WebSession :: issetProperty("Detaconfarch")) {
			$rcconfigarchiv = WebSession :: getProperty("Configarchiv");
			$rcdetaconfarch = WebSession :: getProperty("Detaconfarch");
			$objServ = Application :: loadServices("Data_type");
			//Hace el formateo de campos cadena para la tabla
			$rcresultc["cogacodigos"] = $rcconfigarchiv["configarchiv__cogacodigos"];
			$rcresultc["coganombres"] = $objServ->formatString($rcconfigarchiv["configarchiv__coganombres"]);
			$rcresultc["cogaobservas"] = $objServ->formatString($rcconfigarchiv["configarchiv__cogaobservas"]);
			$rcresultc["tiarcodigos"] = $objServ->formatString($rcconfigarchiv["configarchiv__tiarcodigos"]);
			$rcresultc["cogamarmaess"] = $objServ->formatString($rcconfigarchiv["configarchiv__cogamarmaess"]);
			$rcresultc["cogamardetas"] = $objServ->formatString($rcconfigarchiv["configarchiv__cogamardetas"]);
			$rcresultc["cogaposmaess"] = $rcconfigarchiv["configarchiv__cogaposmaess"];
			$rcresultc["cogaposdetas"] = $rcconfigarchiv["configarchiv__cogaposdetas"];
			$rcresultc["cogasepainis"] = $objServ->formatString($rcconfigarchiv["configarchiv__cogasepainis"]);
			$rcresultc["cogasepafins"] = $objServ->formatString($rcconfigarchiv["configarchiv__cogasepafins"]);
			$rcresultc["coarencabezs"] = $rcconfigarchiv["configarchiv__coarencabezs"];
			$rcresultc["coarextencis"] = $objServ->formatString($rcconfigarchiv["configarchiv__coarextencis"]);
			//se realiza el formateo parael detalle de la configuracion
			$nucant = sizeof($rcdetaconfarch);
			for ($nucont = 0; $nucont < $nucant; $nucont ++) {
				$rcresultd[$nucont]["decocodigon"] = $rcdetaconfarch[$nucont]["decocodigon"];
				$rcresultd[$nucont]["decodescris"] = $objServ->formatString($rcdetaconfarch[$nucont]["decodescris"]);
				$rcresultd[$nucont]["decolon_posn"] = $rcdetaconfarch[$nucont]["decolon_posn"];
				$rcresultd[$nucont]["decotipos"] = $objServ->formatString($rcdetaconfarch[$nucont]["decotipos"]);
				$rcresultd[$nucont]["decoformats"] = $objServ->formatString($rcdetaconfarch[$nucont]["decoformats"]);
				$rcresultd[$nucont]["decovalinis"] = $objServ->formatString($rcdetaconfarch[$nucont]["decovalinis"]);
				$rcresultd[$nucont]["decovalfins"] = $objServ->formatString($rcdetaconfarch[$nucont]["decovalfins"]);
			}
			$configarchiv_manager = Application :: getDomainController('FileConfigurationManager');
			$sbmessage = $configarchiv_manager->updateFileConfiguration($rcresultc, $rcresultd);
			WebRequest :: setProperty('cod_message', $sbmessage);
			if($sbmessage == 3){
				return "success";
			}
			else{
				return "fail";
			}
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 13);
			return "fail";
		}
	}
}
?>	