<?php       
/**
* @Copyright 2004 � FullEngine
*
* Smarty plugin
* Pinta el administrador que permite registrar tareas a una atencion
* @author freina <freina@parquesoft.com>
* @date 14-Feb-2004 15:13
* @location Cali - Colombia
*/
function smarty_function_register_attachment($params, & $smarty) {

	extract($params);
	settype($objgateway, "object");
	settype($rctmpa, "array");
	settype($rctmp, "array");
	settype($rcattachment, "array");
	settype($sbvalue, "string");
	settype($sbvalue, "string");
	settype($sbstate, "string");
	settype($sbordenumeros, "string");
	settype($sbattachment, "string");
	settype($sbestilo, "string");
	settype($nucont, "integer");
	settype($nurows, "integer");

	$sbordenumeros = $_REQUEST["orden__ordenumeros"];
	$sbattachment = $_REQUEST["attachment"];

	//Trae los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	//Trae las etiquetas
	include ($rcuser["lang"]."/".$rcuser["lang"].".anexos.php");

	//se extrae la data de las anexos
	if ($sbattachment) {
		$rctmpa = explode("··", $sbattachment);
	} else {
		//consulta las anexos
		if ($sbordenumeros && $_REQUEST["consult"]!=null && $_REQUEST["consult"]!="") {
			$sbstate = Application :: getConstant("O_ANEXO");
			$objgateway = Application :: getDataGateway("anexos");
			$rcanexo = $objgateway->getByAnexos_fkey($sbordenumeros);
			//Acomoda las anexos con el nombre
			if (is_array($rcanexo)) {
				foreach ($rcanexo as $nucont =>$rctmp)
					$rctmpa[$nucont] = $rctmp["anexnombarch"]."|".$sbstate;
			}
			$_REQUEST["attachment"] = implode("··",$rctmpa);
			$_REQUEST["consult"] = 1;
		}
	}

	$sbhtml .= "<table border='0' align='left' width='70%'>";
	$sbhtml .= "<tr><th colspan='2'><div align='left'>".$rclabels["title"]."</div></th></tr>";
	$sbhtml .= "<tr><th colspan='2'><div align='left'>&nbsp;</div></th></tr>";
	//Pinta el textfield tipo file
	$sbhtml .= "<tr>";
	$sbhtml .= "<td><input type=file name=anexos___anexnombarch size=50 maxlength=100></td>";
	$sbhtml .= "<td><a href='#' onClick=\"$form.action.value='FeCrCmdAddAnexos';$form.submit();\" >";
	$sbhtml .= "<img src='web/images/positivo_002.gif' border='0' align='middle' title=\"".$rclabels["add"]["label"]."\"></a></td>"." 	</tr>";
	$sbhtml .= "<tr><td class='piedefoto'><hr></tr>"."\n";
	//Pinta las opcionaes ya selecionadas
	if ($rctmpa) {
		//Pone los emcabezados
		$sbhtml .= "</tr>";
		$sbhtml .= "<td class='titulofila'>".$rclabels["anexos"]["label"]."</td>";
		$sbhtml .= "<td class='titulofila'>".$rclabels["acciones"]["label"]."</td>";
		$sbhtml .= "</tr>"."\n";
		foreach ($rctmpa as $nucont => $sbvalue) {
			$rcattachment = explode("|",$sbvalue);
			//Calcula el interlineado
			if (($nurows % 2) == 0) {
				$sbestilo = "celda";
			} else{
				$sbestilo = "celda2";
			}
				
			$sbhtml .= "<tr>";
			$sbhtml .="<td class='$sbestilo'>".$rcattachment[0]."</td>";
			$sbhtml .="<td class='$sbestilo'>"."<a href='#' onClick=\"$form.action.value='FeCrCmdDeleteAnexos';$form.deleteattachment.value='$nucont';$form.submit();\">";
			$sbhtml .="<img src='web/images/borrar.gif' border='0' align='middle' title=\"".$rclabels["del"]["label"]."\"></a>"."</td>";
			$sbhtml .="</tr>"."\n";
			$nurows ++;
		}
	}
	$sbhtml .= "</table>";
	return $sbhtml;
}
?>