<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawAnswers($params, & $smarty) {

	extract($_REQUEST);
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcDescP,"array");
	settype($rcDescR,"array");
	settype($rcDescO,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($sbHtml,"string");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".configencuesta.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	$rcSession = WebSession :: getProperty("_rcConfigEncuesta");
	
	if($rcSession[1] && is_array($rcSession[1])){
		//se pinta las respuestas configuradas.
		$rcDescP=$rcSession[2];
		$rcDescR=$rcSession[3];
		$rcDescO=$rcSession[4];
		
		$sbHtml = "<table align=\"center\" border=\"1\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'  colspan='5' >";
		$sbHtml .= $rclabels["questiontitle"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<td align='center'  colspan='5'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["pregcodigon"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["pregpadren"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["objecodigon"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["oprecodigon"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["accion"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		foreach($rcSession[1] as $rcTmp){
			$sbHtml .= "<tr>";
			$sbHtml .= "<td align='center'>";
			$sbHtml .= $rcDescP[$rcTmp["pregcodigon"]];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='center'>";
			if($rcTmp["pregpadren"]){
				$sbHtml .= $rcDescP[$rcTmp["pregpadren"]];
			}else{
				$sbHtml .="&nbsp";
			}
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='center'>";
			$sbHtml .= $rcDescO[$rcTmp["objecodigon"]];
			$sbHtml .= "</td>";
			$sbHtml .= "<td  align='center'>";
			if($rcTmp["answer"] && is_array($rcTmp["answer"])){
				$sbHtml .= "<table border=\"1\" align=\"center\" width=\"100%\">";
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
				foreach($rcTmp["answer"] as $rcRow){
					$sbHtml .= "<tr>";
					$sbHtml .= "<td align='center'>";
					$sbHtml .= $rcDescR[$rcRow["oprecodigon"]];
					$sbHtml .= "</td>";
					$sbHtml .= "<td align='center'>";
					$sbHtml .= "<input type='text' name='preg_o_".$rcTmp["pregcodigon"]."_".$rcRow["oprecodigon"]."' id='preg_o_".$rcTmp["pregcodigon"]."_".$rcRow["oprecodigon"]."' onkeypress=\"isInteger(event);\" size='3' maxlength='3' value=\"".$rcRow["reprordenn"]."\">";
					$sbHtml .= "</td>";
					$sbHtml .= "<td align='center'>";
					$sbHtml .= "<input type='text' name='preg_p_".$rcTmp["pregcodigon"]."_".$rcRow["oprecodigon"]."' id='preg_p_".$rcTmp["pregcodigon"]."_".$rcRow["oprecodigon"]."' onkeypress=\"isInteger(event);\" size='3' maxlength='3' value=\"".$rcRow["reprpeson"]."\">";
					$sbHtml .= "</td>";
					$sbHtml .= "<td align='center'>";
					if($rcRow["oprepadren"]){
						$sbHtml .= $rcDescR[$rcRow["oprepadren"]];
					}else{
						$sbHtml .="&nbsp";
					}
					$sbHtml .= "</td>";
					$sbHtml .= "</tr>";
				}
				$sbHtml .= "</table>";
			}else{
				$sbHtml .="&nbsp";
			}
			$sbHtml .= "</td>";
			
			$sbHtml .= "<td align='center'>";
			$sbHtml .= "<a href=# onclick=\"var sbResult = confirm('".$rclabels["pregunta_e"]["label"]."'); if(sbResult == true){jsUpdate('".$rcTmp["pregcodigon"]."');disableButtons();}\">";
			$sbHtml .= "<img src=web/images/editar.gif border=0 title='".$rclabels_generic['editar']."'></a>";
			$sbHtml .= "<a href=# onclick=\"var sbResult = confirm('".$rclabels["pregunta"]["label"]."'); if(sbResult == true){jsDelete('".$rcTmp["pregcodigon"]."');disableButtons();}\">";
			$sbHtml .= "<img src=web/images/ico_basura.gif border=0 title='".$rclabels_generic['eliminar']."'></a>";
			$sbHtml .= "</td>";
			
			$sbHtml .= "</tr>";
			
		}
		$sbHtml .= "</table>";
	}
	return $sbHtml;
}
?>