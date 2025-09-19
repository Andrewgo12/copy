<?php
/*
 * Created on 21-abr-2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

function smarty_function_set_schema($params, & $smarty){

	settype($objService,"object");
	settype($rcUser,"array");
	settype($rcSchemas,"array");
	settype($rcRow,"array");
	settype($sbHtml,"string");
	settype($sbSelected,"string");
	settype($nuCant,"integer");
	extract ($params);

	//Obtiene los datos del usuario
	$rcUser = Application :: getUserParam();
	$sbHtml = "&nbsp;";

	include ($rcUser["lang"]."/".$rcUser["lang"].".datauser.php");

	if($rcUser["schema"]) {
		$objService = Application::loadServices("Profiles");
		$rcSchemas = $objService->getSchemasUsuario();
			
		if(is_array($rcSchemas)) {
			$nuCant = sizeof($rcSchemas);
			if($nuCant > 1){
				$sbHtml = "<b>".$rclabels['context']['label']."</b>&nbsp;";
				$sbHtml .= '<select name="schecodigon" onChange="parent.location=\'../profiles/index.php?action=FePrCmdSetschema&schecodigon=\'+this.value;">';
				foreach ($rcSchemas as $rcRow) {
					if($rcUser["schema"] == $rcRow["schecodigon"]){
						$sbSelected = " selected";
					}else{
						$sbSelected = " ";
					}
					$sbHtml .= '<option value=\''.$rcRow["schecodigon"].'\' '.$sbSelected.'>'.$rcRow["schenombres"];
				}
			}
		}
	}

	return $sbHtml;
}
?>