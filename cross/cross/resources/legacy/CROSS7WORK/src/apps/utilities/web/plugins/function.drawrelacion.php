<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawRelacion($params, & $smarty) {

	extract($_REQUEST);
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($sbHtml,"string");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".tareapersona.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	$rcSession = WebSession :: getProperty("_rcRelacionTarea_Persona");
	
	if($rcSession[1] && is_array($rcSession[1])){
		//se pinta las respuestas configuradas.
		
		$sbHtml = "<table align=\"center\" border=\"1\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'  colspan='3' >";
		$sbHtml .= $rclabels["title1"]["label"].$rcSession[0]["tarenombres"].$rclabels["title2"]["label"].$rcSession[0]["procnombres"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'  colspan='3'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["orgacodigos"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["organombres"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["accion"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		foreach($rcSession[1] as $rcTmp){
			$sbHtml .= "<tr>";
			$sbHtml .= "<td align='center'>";
			$sbHtml .= $rcTmp["orgacodigos"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='center'>";
			$sbHtml .= $rcTmp["organombres"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='center'>";
			$sbHtml .= "<a href=# onclick=\"var sbResult = confirm('".$rclabels["pregunta"]["label"]."'); if(sbResult == true){jsDelete('".$rcTmp["orgacodigos"]."');disableButtons();}\">";
			$sbHtml .= "<img src=web/images/ico_basura.gif border=0 title='".$rclabels_crl['CmdDelete']."'></a>";
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
			
		}
		$sbHtml .= "</table>";
	}
	return $sbHtml;
}
?>