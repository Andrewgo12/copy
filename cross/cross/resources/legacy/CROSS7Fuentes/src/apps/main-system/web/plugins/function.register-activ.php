<?php   
/**
* @Copyright 2004 � FullEngine
*
* Smarty plugin
* Pinta el administrador que permite registrar tareas a una atencion
* @author creyes <cesar.reyes@parquesoft.com>
* @date 09-dic-2004 10:26:01
* @location Cali - Colombia
*/
function smarty_function_register_activ($params, & $smarty) {

	extract($params);
	settype($rctmpa,"array");
	settype($sbvalue,"string");
	settype($sbName,"string");
	settype($sbAccessKey,"string");
	settype($nucont,"integer");

	//se extrae la data de las actividades
	if($_REQUEST["activities"]){
		$rctmpa = explode(",",$_REQUEST["activities"]);
	}
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) 
	{
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}
	//Trae las etiquetas
	include ($rcUser["lang"]."/".$rcUser["lang"].".actaempresa.php");

	//consulta las actividades
	$gatewayActivi = Application :: getDataGateway("actaempresaExtended");
	$rcActividad = $gatewayActivi->getAactiveActividad($_REQUEST['acta']);

	//Acomoda las actividades con el nombre
	if(is_array($rcActividad)){
		foreach($rcActividad as $rcTmp)
			$rcLabelActivi[$rcTmp["acticodigos"]] = $rcTmp["actinombres"];
	}
	$rcHtml[] = "<table border='0' align='left' width='100%'>";
	$rcHtml[] = "<tr><th colspan='2'><div align='left'>".$rclabels["actividades"]["label"]."</div></th></tr>";
	$rcHtml[] = "<tr><td colspan='2'><div align='left'>".$rclabels["actividades"]["commentary"]."</div></td></tr>";
	
	//Pinta el combo que adiciona
	$sbCombo = getComboActivi($rcActividad,$rctmpa, "cmbOriginal");
	$rcHtml[] = "<tr>" .
	"		<td width='25%'>$sbCombo</td>" .
	"		<td align=\"left\"><a href='#' onClick=\"$form.action.value='FeCrCmdAddactiviacta';$form.submit();\" ><img src='web/images/positivo_002.gif' border='0' align='middle' title=\"".$rclabels["add"]["label"]."\"></a></td>" .
	" 	</tr>";

	//Pinta las opcionaes ya selecionadas
	if ($rctmpa){
		//Pone los emcabezados
		$rcHtml[] = "<tr>" .
		"		<td class='titulofila'>".$rclabels["actividades"]["label"]."</td>" .
		"		<td class='titulofila'>".$rclabels["acciones"]["label"]."</td>" .
		" 	</tr>";
		$rows = 0;
		foreach($rctmpa as $nucont => $sbvalue)
		{
			//Calcula el interlineado
			if (($rows % 2) == 0)
				$estilo = "celda";
			else
				$estilo = "celda2";
			$rcHtml[] = "<tr>" .
			"		<td class='$estilo'>".$rcLabelActivi[$sbvalue]."</td>" .
			"		<td class='$estilo'>" .
			"			<a href='#' onClick=\"$form.action.value='FeCrCmdDeleteActiviacta';$form.delactiviacta.value='$nucont';$form.submit();\"><img src='web/images/borrar.gif' border='0' align='middle' title=\"".$rclabels["del"]["label"]."\"></a>" .
			"       </td>" .
			" 	</tr>";
			$rows++;
		}
	}
	$rcHtml[] = "</table>";
	return implode("\n", $rcHtml);
}
/**
* @Copyright 2004 � FullEngine
*
* Arma un combobox y retorna la cadena
* @param array $rcActividades Vector con las actividades
* @param string $nameCombo Nombre del combo
* @param string $selected valor del dato selecionado
* @return string
* @author creyes <cesar.reyes@parquesoft.com>
* @date 09-dic-2004 10:54:23
* @location Cali - Colombia
*/
function getComboActivi($rcActividades, $rcSelected,$nameCombo, $selected = null) {
	if (!is_array($rcActividades))
		return null;
	if (!is_array($rcSelected))
		$rcSelected = array();
	$rcHtml[] = "<select name='".$nameCombo."[]' multiple size=5>";
	$rcHtml[] = "\t<option value=''>---</option>";
	foreach ($rcActividades as $rcTmp) 
	{
		if(!in_array($rcTmp["acticodigos"],$rcSelected))
		{
			$sbHtml = "\t<option value='".$rcTmp["acticodigos"]."'";
			if($rcTmp["acticodigos"] == $selected)
			$sbHtml .= " selected ";
			$sbHtml .= ">".$rcTmp["actinombres"]."</option>";
			$rcHtml[] = $sbHtml;
		}
	}
	$rcHtml[] = "</select>";
	return implode("\n",$rcHtml);
}
?>