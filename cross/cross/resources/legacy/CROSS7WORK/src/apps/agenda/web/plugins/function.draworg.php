<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawOrg($params, & $smarty) {

	extract($_REQUEST);
	extract($params);
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($sbHtml,"string");
	settype($sbIndex,"string");
	settype($sbValue,"string");

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".schedule.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	$rcSession = WebSession :: getProperty("_rcOrgSchedule");
	
	if($rcSession && is_array($rcSession)){
		//se pinta el resultado
		
		$sbHtml = "<table align=\"center\" width=\"90%\" border=\"1\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'  colspan='3' >";
		$sbHtml .= $rclabels["orgtitle"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'  colspan='3'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		foreach($rcSession as $sbIndex=>$sbValue){
			$sbHtml .= "<tr>";
			$sbHtml .= "<td align='center'>".$sbIndex."</td>";
			$sbHtml .= "<td align='left'>".$sbValue."</td>";
			$sbHtml .= "<td align='center'>";
			$sbHtml .= "<a href=# onclick=\"var sbResult = confirm('".$rclabels["pregunta"]["label"]."'); if(sbResult == true){jsDelete('".$sbIndex."');disableButtons();}\">";
			$sbHtml .= "<img src=web/images/ico_basura.gif border=0 title='".$rclabels_generic['eliminar']."'></a>";
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
		}
			
		$sbHtml .= "</table>";
	}
	return $sbHtml;
}
?>