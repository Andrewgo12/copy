<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawRespuestas($params, & $smarty) {

	extract($_REQUEST);
	extract($params);
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($rcResult,"array");
	settype($sbHtml,"string");
	settype($sbOption,"string");

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".configencuesta.php");
	
	$rcSession = WebSession :: getProperty("_rcAnswer");
	
	if($rcSession && is_array($rcSession)){
		//se pinta las respuestas configuradas.
		//se pinta el resultado
		
		if($pregpadren){
			//se obtiene luego las respuestas padre de acuerdo a la configuacion existente.
			$rcTmp = WebSession :: getProperty("_rcConfigEncuesta");
				
			if($rcTmp && is_array($rcTmp)){
				//se determina el registro de la pregunta padre
				foreach($rcTmp[1] as $rcRow){
					if($pregpadren==$rcRow["pregcodigon"]){
						$rcResult = $rcRow["answer"];
						break;
					}
				}
					
				if($rcResult && is_array($rcResult)){
					//se genera el archivo de opciones del select
					$sbOption = "<option value=''>---</option>";
					foreach($rcResult as $rcRow){
						$sbOption .= "<option value='".$rcRow["oprecodigon"]."'>".$rcTmp[3][$rcRow["oprecodigon"]]."</option>";
					}
				}
			}
		}
		
		
		$sbHtml = "<table align=\"center\" width=\"90%\" border=\"1\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'  colspan='4' >";
		$sbHtml .= $rclabels["answertitle"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["oprecodigon_1"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["reprordenn"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["reprpeson"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["oprepadren"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'  colspan='4'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		foreach($rcSession[0] as $rcRow){
			$sbHtml .= "<tr>";
			$sbHtml .= "<td align='left'>".$rcSession[1][$rcRow["oprecodigon"]]."</td>";
			$sbHtml .= "<td><input type='text' name='text_o_".$rcRow["oprecodigon"]."' onkeypress=\"isInteger(event);\" size='3' maxlength='3'></td>";
			$sbHtml .= "<td><input type='text' name='text_p_".$rcRow["oprecodigon"]."' onkeypress=\"isInteger(event);\" size='3' maxlength='3'></td>";
			if($sbOption){
				$sbHtml .= "<td align='center'><select name='select_".$rcRow["oprecodigon"]."' id='select_".$rcRow["oprecodigon"]."'>".$sbOption."</select></td>";
			}else{
				$sbHtml .= "<td>&nbsp;</td>";
			}
			$sbHtml .= "</tr>";
		}
			
		$sbHtml .= "</table>";
	}
	return $sbHtml;
}
?>