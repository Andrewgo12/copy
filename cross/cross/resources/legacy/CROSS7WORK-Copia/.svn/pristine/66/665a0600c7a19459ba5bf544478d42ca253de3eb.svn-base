<?php
/*
 * Created on 21-abr-2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

function smarty_function_data_personal($params, & $smarty){
	
	settype($objService,"object");
	settype($objDate, "object");
	settype($rcUser,"array");
	settype($rcPersDatos,"array");
	settype($sbHtml,"string");
	settype($sbDate,"string");
	extract ($params);

	//Obtiene los datos del usuario
	$rcUser = Application :: getUserParam();

	//Obtiene los entes organizacionales en los cuales el usuario es responsable
	$objService = Application :: loadServices("Human_resources");
	$rcPersDatos = $objService->getPersDatos($rcUser["username"]);

	$objDate = Application::loadServices("DateController");
	$sbDate = $objDate->getLongDate($rcUser["lang"]);

	include ($rcUser["lang"]."/".$rcUser["lang"].".datauser.php");

	if($rcPersDatos){
		$sbHtml .= '<b>'.$sbDate.'&nbsp;&nbsp;&nbsp;'.$rcPersDatos['persnombres'].' '.$rcPersDatos['persapell1s'].' '.$rcPersDatos['persapell2s'].' '.$rclabels['user']['label'].' '.$rcPersDatos['persusrnams'].'</b>';
	}else{
		$sbHtml .= '<b>'.$sbDate.'&nbsp;&nbsp;&nbsp;'.$rcUser["username"].'</b>';
	}

	return $sbHtml;
}
?>