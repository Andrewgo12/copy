<?php 
/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Smarty pligin .
	* Pinta los campos adicionales dependiendo del tipo de recurso, serado o no
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 04-oct-2004 10:27:13
	* @location Cali-Colombia*/

function smarty_function_extra_fields($params, & $smarty) {
	extract($params);
	if (!$_REQUEST["movimialmace__recucodigos"])
		return null;
	//Consulta el recurso
	$gateWay = Application :: getDataGateway("recurso");
	$rcRecurso = $gateWay->getByIdRecurso($_REQUEST["movimialmace__recucodigos"]);
	if (!is_array($rcRecurso))
		return null;
	//Trae el codigo para el tipo de recurso seriado desde las constantes
	$TipRecSer = Application :: getConstant("COD_REC_SER");
	if ($rcRecurso[0]["tirecodigos"] != $TipRecSer){
		return null;
	}
	//Obtiene los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
	//Trae las etiquetas de la forma
	include_once ($rcUser["lang"]."/".$rcUser["lang"].".movimialmace.php");
	
	$rcHtml[] = "<table width=\"100%\">";
	$rcHtml[] = "	<tr>";
	$rcHtml[] = "		<td>".$rclabels["prefix"]["label"]."</td>";
	$rcHtml[] = "		<td><input type='text' name='movimialmace__prefix' size='8' value='".$_REQUEST["movimialmace__prefix"]."'></td>";
	$rcHtml[] = "		<td>".$rclabels["suffix"]["label"]."</td>";
	$rcHtml[] = "		<td><input type='text' name='movimialmace__suffix' size='8'  value='".$_REQUEST["movimialmace__suffix"]."'></td>";
	$rcHtml[] = "	</tr>";
	$rcHtml[] = "	<tr>";
	$rcHtml[] = "		<td>".$rclabels["serial1"]["label"]."</td>";
	$rcHtml[] = "		<td><input type='text' name='movimialmace__serial1'  value='".$_REQUEST["movimialmace__serial1"]."'><b>*</b></td>";
	$rcHtml[] = "		<td>".$rclabels["serial2"]["label"]."</td>";
	$rcHtml[] = "		<td><input type='text' name='movimialmace__serial2'  value='".$_REQUEST["movimialmace__serial2"]."'></td>";
	$rcHtml[] = "	</tr>";
	$rcHtml[] = "	<input type='hidden' name='serial_move' value='OK'>";
	$rcHtml[] = "</table>";
	echo implode("\n", $rcHtml);
}
?>