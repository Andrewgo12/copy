<?php       
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdAddDetaconfarch {
	function execute() {
		extract($_REQUEST);
		settype($objServ, "object");
		settype($rctmp, "array");
		settype($nucant, "integer");
		if (($detaconfarch__decodescris != NULL) && ($detaconfarch__decodescris != "") && 
		($detaconfarch__decolon_posn != NULL) && ($detaconfarch__decolon_posn != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de campos numericos y formateo de campos cadena
			if ($objServ->isInteger($detaconfarch__decolon_posn) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}		
			if (!(WebSession :: issetProperty("Detaconfarch"))) {
				$rctmp[0]["decocodigon"] = 1;
				$rctmp[0]["decodescris"] = $detaconfarch__decodescris;
				$rctmp[0]["decolon_posn"] = $detaconfarch__decolon_posn;
				$rctmp[0]["decotipos"] = $detaconfarch__decotipos;
				$rctmp[0]["decoformats"] = $detaconfarch__decoformats;
				$rctmp[0]["decovalinis"] = $detaconfarch__decovalinis;
				$rctmp[0]["decovalfins"] = $detaconfarch__decovalfins;
				WebSession :: setProperty("Detaconfarch", $rctmp);
			} else {
				$rctmp = WebSession :: getProperty("Detaconfarch");
				if ($rctmp) {
					$nucant = sizeof($rctmp);
					$rctmp[$nucant]["decocodigon"] = $nucant +1;
					$rctmp[$nucant]["decodescris"] = $detaconfarch__decodescris;
					$rctmp[$nucant]["decolon_posn"] = $detaconfarch__decolon_posn;
					$rctmp[$nucant]["decotipos"] = $detaconfarch__decotipos;
					$rctmp[$nucant]["decoformats"] = $detaconfarch__decoformats;
					$rctmp[$nucant]["decovalinis"] = $detaconfarch__decovalinis;
					$rctmp[$nucant]["decovalfins"] = $detaconfarch__decovalfins;
					WebSession :: setProperty("Detaconfarch", $rctmp);
				} else {
					$rctmp[0]["decocodigon"] = 1;
					$rctmp[0]["decodescris"] = $detaconfarch__decodescris;
					$rctmp[0]["decolon_posn"] = $detaconfarch__decolon_posn;
					$rctmp[0]["decotipos"] = $detaconfarch__decotipos;
					$rctmp[0]["decoformats"] = $detaconfarch__decoformats;
					$rctmp[0]["decovalinis"] = $detaconfarch__decovalinis;
					$rctmp[0]["decovalfins"] = $detaconfarch__decovalfins;
					WebSession :: setProperty("Detaconfarch", $rctmp);
				}
			}
			$message = 3;
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	