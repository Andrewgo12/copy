<?php       
/**
* @Copyright 2006 FullEngine
*
* Smarty plugin
* Pinta el administrador que permite anexar archivos a una atencion
* @author freina <freina@parquesoft.com>
* @date 19-Dec-2006 09:59
* @location Cali - Colombia
*/
function smarty_function_register_attachment_atencion($params, & $smarty) {

	extract($params);
	settype($objGateway, "object");
	settype($rcFileName, "array");
	settype($rcTmp, "array");
	settype($rcUser, "array");
	settype($sbValue, "string");
	settype($sbEstilo, "string");
	settype($nuCont, "integer");
	settype($nuRows, "integer");

	
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
	
	//se obtienen los archivos ya guardados
	$rcFileName = WebSession :: getProperty("_rcFileList");
	
	//Trae las etiquetas
	include ($rcUser["lang"]."/".$rcUser["lang"].".anexos.php");

	$sbhtml .= "<table border='0' align='left' width='70%'>";
	$sbhtml .= "<tr><th colspan='2'><div align='left'>".$rclabels["title"]."</div></th></tr>";
	$sbhtml .= "<tr><th colspan='2'><div align='left'>&nbsp;</div></th></tr>";
	//Pinta el textfield tipo file
	$sbhtml .= "<tr>";
	$sbhtml .= "<td width='85%'><input type=file name=anexo size=50 maxlength=100></td>";
	$sbhtml .= "<td width='15%'><a href='#' onClick=\"$form.action.value='FeCrCmdAddAnexosAT';$form.submit();\" >";
	$sbhtml .= "<img src='web/images/positivo_002.gif' border='0' align='middle' title=\"".$rclabels["add"]["label"]."\"></a></td>"." 	</tr>";
	$sbhtml .= "<tr><td class='piedefoto'><hr></tr>"."\n";
	//Pinta las opcionaes ya selecionadas
	if ($rcFileName) {
		//Pone los emcabezados
		$sbhtml .= "</tr>";
		$sbhtml .= "<td class='titulofila'>".$rclabels["anexos"]["label"]."</td>";
		$sbhtml .= "<td class='titulofila'>".$rclabels["acciones"]["label"]."</td>";
		$sbhtml .= "</tr>"."\n";
		foreach ($rcFileName as $nuCont => $rcTmp) {
			
			//Calcula el interlineado
			if (($nuRows % 2) == 0) {
				$sbEstilo = "celda";
			} else{
				$sbEstilo = "celda2";
			}
				
			$sbhtml .= "<tr>";
			$sbhtml .="<td class='$sbEstilo'>".$rcTmp["name"]."</td>";
			$sbhtml .="<td class='$sbEstilo'>"."<a href='#' onClick=\"$form.action.value='FeCrCmdDeleteAnexosAT';$form.deleteattachment.value='".$rcTmp["index"]."';$form.submit();\">";
			$sbhtml .="<img src='web/images/borrar.gif' border='0' align='middle' title=\"".$rclabels["del"]["label"]."\"></a>"."</td>";
			$sbhtml .="</tr>"."\n";
			$nuRows ++;
		}
	}
	$sbhtml .= "</table>";
	return $sbhtml;
}
?>