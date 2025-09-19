<?php       
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdUpdateDetaconfarch {
	function execute() {
		extract($_REQUEST);
		settype($objServ, "object");
		settype($rctmp, "array");
		settype($rcnew, "array");
		settype($rcvalue, "array");
		settype($rcresult, "array");
		settype($sbtmp, "string");
		settype($sbflag, "string");
		settype($sbmessage, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nucontr, "integer");
		$sbflag = true;
		$sbtmp = "detaconfarch__decocodigon".$indice;
		$detaconfarch__decocodigon = $$sbtmp;
		$sbtmp = "detaconfarch__decodescris".$indice;
		$detaconfarch__decodescris = $$sbtmp;
		$sbtmp = "detaconfarch__decolon_posn".$indice;
		$detaconfarch__decolon_posn = $$sbtmp;
		$sbtmp = "detaconfarch__decotipos".$indice;
		$detaconfarch__decotipos = $$sbtmp;
		$sbtmp = "detaconfarch__decoformats".$indice;
		$detaconfarch__decoformats = $$sbtmp;
		$sbtmp = "detaconfarch__decovalinis".$indice;
		$detaconfarch__decovalinis = $$sbtmp;
		$sbtmp = "detaconfarch__decovalfins".$indice;
		$detaconfarch__decovalfins = $$sbtmp;
		if (($detaconfarch__decocodigon != NULL) && ($detaconfarch__decocodigon != "") 
		&& ($detaconfarch__decodescris != NULL) && ($detaconfarch__decodescris != "")
		&& ($detaconfarch__decolon_posn != NULL) && ($detaconfarch__decolon_posn != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de campos numericos y formateo de campos cadena
			if ($objServ->isInteger($detaconfarch__decocodigon) == false) {
				WebRequest :: setProperty('cod_message', $sbmessage = 4);
				return "fail";
			}	
			if ($objServ->isInteger($detaconfarch__decolon_posn) == false) {
				WebRequest :: setProperty('cod_message', $sbmessage = 4);
				return "fail";
			}
			if (WebSession :: issetProperty("Detaconfarch")) {
				$rctmp = WebSession :: getProperty("Detaconfarch");
				if ($rctmp) {
					$nucant = sizeof($rctmp);
					//se valida que la posicion sea valida
					if ($detaconfarch__decocodigon <= 0 || $detaconfarch__decocodigon > $nucant) {
						$detaconfarch__decocodigon = $nucant;
					}
					$rcnew["decocodigon"] = $detaconfarch__decocodigon;
					$rcnew["decodescris"] = $detaconfarch__decodescris;
					$rcnew["decolon_posn"] = $detaconfarch__decolon_posn;
					$rcnew["decotipos"] = $detaconfarch__decotipos;
					$rcnew["decoformats"] = $detaconfarch__decoformats;
					$rcnew["decovalinis"] = $detaconfarch__decovalinis;
					$rcnew["decovalfins"] = $detaconfarch__decovalfins;
					unset ($rctmp[$indice -1]);
					foreach ($rctmp as $nucont => $rcvalue) {
						if ($nucontr == ($detaconfarch__decocodigon -1)) {
							$rcresult[$nucontr] = $rcnew;
							$nucontr ++;
							$rcvalue["decocodigon"] = $nucontr +1;
							$rcresult[$nucontr] = $rcvalue;
							$sbflag = false;
						} else {
							$rcvalue["decocodigon"] = $nucontr +1;
							$rcresult[$nucontr] = $rcvalue;
						}
						$nucontr ++;
					}
					if ($sbflag) {
						$rcresult[$nucant] = $rcnew;
					}
				}
				WebSession :: setProperty("Detaconfarch", $rcresult);
			}
			$sbmessage = 3;
			WebRequest :: setProperty('cod_message', $sbmessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 0);
			return "fail";
		}
	}
}
?>	