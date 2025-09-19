<?php 
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pone el estilo de las formas
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_function_lst_recursos($params, & $smarty) {
	$genericData = WebSession :: getProperty("genericData");
	if (!is_array($genericData)) {
		return false;
	}
	//Parametros del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	include ($rcuser["lang"]."/".$rcuser["lang"].".movimialmace.php");
	include ($rcuser["lang"]."/".$rcuser["lang"].".generic.php");

	$rcHtml[] = "<div align=center><table  width=\"50%\">";
	$rcHtml[] = "	<tr>";
	$rcHtml[] = "		<td class=titulofila>".$rclabels["recucodigos"]["label"]."</td>";
	$rcHtml[] = "		<td class=titulofila>".$rclabels["moalcantrecf"]["label"]."</td>";
	$rcHtml[] = "		<td class=titulofila>".$rclabels["serial1"]["label"]." - ".$rclabels["serial2"]["label"]."</td>";
	$rcHtml[] = "		<td class=titulofila>&nbsp;</td>";
	$rcHtml[] = "</tr>";

	foreach ($genericData as $key => $rcRec) {
		if ($key % 2)
			$tdStyle = "celda";
		else
			$tdStyle = "celda2";

		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td class='$tdStyle'><table width=\"100%\"><tr><td class='$tdStyle'>".$rcRec["recucodigos"]."</td><td class='$tdStyle'>".$rcRec["recunombres"]."</td></tr></table></td>";
		if (!is_array($rcRec["series"])) {
			$rcHtml[] = "		<td class='$tdStyle'><div align=center>".$rcRec["moalcantrecf"]."</td></div></td>";
			$rcHtml[] = "		<td class='$tdStyle'><div align=center>&nbsp;</td></div></td>";
		} else {
			$nuKey = sizeof($rcRec["series"]);
			$keyLast = sizeof($rcRec["series"]) - 1;
			if ($nuKey == 1) {
				$rcCant[0] = $rcRec["series"][0]["serial2"] - $rcRec["series"][0]["serial1"] + 1;
				$rcSerials[0] = "<a href='#' onClick=\"javascript:frmMovimialmaceConsult.action.value='FeStCmdDeleteMovimialmace';frmMovimialmaceConsult.registro.value='$key';frmMovimialmaceConsult.submit();\">".$rcRec["series"][0]["serials"]."</a>";
			} else {
				foreach ($rcRec["series"] as $serKey => $serials) {
					$rcCant[] = $serials["serial2"] - $serials["serial1"] + 1;
					$rcSerials[] = "<a href='#' onClick=\"javascript:frmMovimialmaceConsult.action.value='FeStCmdDeleteMovimialmace';frmMovimialmaceConsult.registro.value='$key';frmMovimialmaceConsult.serial.value='$serKey';frmMovimialmaceConsult.submit();\">".$serials["serials"]."</a>";
				}
			}
			$rcHtml[] = "		<td class='$tdStyle'><div align=center>".implode("<br>", $rcCant)."</div></td>";
			$rcHtml[] = "		<td class='$tdStyle'><div align=left>".implode("<br>", $rcSerials)."</div></td>";
			unset ($rcCant);
			unset ($rcSerials);
		}
		$rcHtml[] = "		<td class='$tdStyle'><div align=middle><a href='#' onClick=\"javascript:frmMovimialmaceConsult.action.value='FeStCmdDeleteMovimialmace';frmMovimialmaceConsult.registro.value='$key';frmMovimialmaceConsult.submit(); \" title='".$rclabels_generic["delete_reg"]."'><img src='web/images/borrar.gif' border='0'></a></div></td>";
		$rcHtml[] = "	</tr>";
	}
	$rcHtml[] = "</table></div>";
	echo implode("\n", $rcHtml);
}
?>