<?php
/**Copyright 2004 FullEngine

Consulta y pinta las tareas asignadas a un ente organizacional
@author creyes <cesar.reyes@parquesoft.com>
@date 01-sep-2004 11:08:26
@location Cali - Colombia
Amended
@author freina<freina@parquesoft.com>
@date 02-Nov-2010 13:20:00
Se modifica para habilitar el guardado de los porcentajes de tiempo para cada tarea.
*/

function smarty_function_viewrutas($params, & $smarty) {

	extract($_REQUEST);
	extract($params);

	settype($objGateway,"object");
	settype($objDate, "object");
	settype($rcIndexTareas,"array");
	settype($rcIndexEstados,"array");
	settype($rcIndexReglas,"array");
	settype($rcUser,"array");
	settype($rcTipoIni,"array");
	settype($rcRutas,"array");
	settype($rcTmp,"array");
	settype($rcHtml,"array");
	settype($rcRutaRegla,"array");
	settype($sbEstilo,"string");
	settype($sbChangeStyle,"string");
	settype($sbChange,"string");
	settype($sbForm,"string");
	settype($sbDivId,"string");
	settype($sbTareaIni,"string");
	settype($sbProcesoIni,"string");
	settype($sbJs,"string");
	settype($sbErrors,"string");

	if (!$proceso__proccodigos){
		return null;	
	}
	
	//Hace la validacion de permisos
	if (Application :: validateProfiles('FeWFCmdDefaultRuta') == false){
		return null;	
	}
	
	$objDate = Application :: loadServices("DateController");

	//Consulta las rutas del proceso
	$objGateway = Application :: getDataGateway("proceso");
	$rcRutas = $objGateway->getRutas($proceso__proccodigos);

	//Consulta las tareas
	$rcIndexTareas = $objGateway->getIndexTareas();
	//Consulta los estado por tarea
	$rcIndexEstados = $objGateway->getIndexEstados();
	//Consulta las reglas
	$rcIndexReglas = $objGateway->getIndexReglas();

	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	//Trae las etiquetas
	include ($rcUser["lang"]."/".$rcUser["lang"].".proceso.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

	$sbErrors = "var errores = new Array();" .
					"errores[100] = '{$rcmessages[100]}';" .
					"errores[3] = '{$rcmessages[3]}';" .
					"errores[1] = '{$rcmessages[1]}';" .
					"errores[0] = '{$rcmessages[0]}';" .
					"errores[2] = '{$rcmessages[2]}';" .
					"errores[6] = '{$rcmessages[6]}';";

	$sbTareaIni = Application :: getConstant("INI_TAR");
	$sbProcesoIni = Application :: getConstant("TAR_INI_PRO");
	$rcTipoIni[$sbProcesoIni] = $rclabels["ip"]["label"];
	$rcTipoIni[$sbTareaIni] = $rclabels["it"]["label"];

	$rcHtml[] = "<table width=\"100%\" cellSpacing='1' cellPadding='3' align='center' border='0'>";
	$rcHtml[] = "<tr><th colspan='5'><div align='left'>".$rclabels["worklist"]["label"]."</div></th></tr>";

	//Pinta el enlace del adicionar tarea

	if (Application :: validateProfiles('FeWFCmdAddRuta') == true) {
		$rcHtml[] = "<tr><td colspan='5'><div align='left'>";
		$rcHtml[] = "	<form name='frmAddRuta' method='post'>";
		$rcHtml[] = "		<input type='hidden' name='newruta'>";
		$rcHtml[] = "		<a href='#' onClick=\"document.frmAddRuta.newruta.value=1;document.frmAddRuta.submit();\" >{$rclabels["addtarea"]["label"]}</a>";
		$rcHtml[] = "	</form>";
		$rcHtml[] = "</div></td></tr>";
	}
	//Pinta las cabeceras
	$rcHtml[] = "<tr>";
	$rcHtml[] = "<td class='titulofila'>{$rclabels["tarea"]["label"]}</td>";
	$rcHtml[] = "<td class='titulofila'>{$rclabels["estado"]["label"]}</td>";
	$rcHtml[] = "<td class='titulofila'>{$rclabels["nexttarea"]["label"]}</td>";
	$rcHtml[] = "<td class='titulofila'>{$rclabels["tipoini"]["label"]}</td>";
	$rcHtml[] = "<td class='titulofila'>{$rclabels["tiempo_tarea"]["label"]}</td>";
	$rcHtml[] = "<td class='titulofila'>{$rclabels["rule"]["label"]}</td>";
	$rcHtml[] = "<td class='titulofila'>{$rclabels["action"]["label"]}</td>";
	$rcHtml[] = "</tr>";

	//Pinta las formas de las rutas
	if (is_array($rcRutas) && $rcRutas) {
		foreach ($rcRutas as $nuIndex => $rcTmp) {
			//Calcula el interlineado
			if (fmod($nuIndex, 2) == 0){
				$sbEstilo = "celda";	
			}else{
				$sbEstilo = "celda2";	
			}
			
			$sbForm = "frmRuta_".$rcTmp['rutacodigon'];
			$sbDivId = "rutacantien_".$rcTmp['rutacodigon']."_div";
			$sbChangeStyle = "onchange=\"if(this.value){changeStyle('".$sbForm."');}jsViewPercent('".$sbForm."','".$sbDivId."','".$sbProcesoIni."');\"";
			$rcHtml[] = "<form name='".$sbForm."' method='post'>";
			$rcHtml[] = "	<input type='hidden' name='rutacodigon' value='{$rcTmp['rutacodigon']}'>";
			$rcHtml[] = "	<input type='hidden' name='proccodigos' value='{$rcTmp['proccodigos']}'>";
			$rcHtml[] = "	<tr>";
			$rcHtml[] = "		<td class='$sbEstilo'>";
			$sbChange = "onchange=\"if(this.value){".
													"LoadSelect('estadotarea','tarecodigos',Array(this),this.form.rutaesactas,'rutaesactas');".
													"loadrutatarsigs(this.form.tarecodigos, this.form.rutatarsigs, this.form.tarecodigos.value);" .
													"changeStyle('".$sbForm."');}
													jsViewPercent('".$sbForm."','".$sbDivId."','".$sbProcesoIni."');".
												  "\"";
			$rcHtml[] = doSelect($rcIndexTareas, 'tarecodigos', $rcTmp['tarecodigos'], $sbChange, null, false);
			$rcHtml[] = "		</td>";
			$rcHtml[] = "		<td class='$sbEstilo'>";
			$rcHtml[] = doSelect($rcIndexEstados[$rcTmp['tarecodigos']], 'rutaesactas', $rcTmp['rutaesactas'], $sbChangeStyle, null, false);
			$rcHtml[] = "		</td>";
			$rcHtml[] = "		<td class='$sbEstilo'>";
			$rcHtml[] = doSelect($rcIndexTareas, 'rutatarsigs', $rcTmp['rutatarsigs'], $sbChangeStyle, $rcTmp['tarecodigos']);
			$rcHtml[] = "		</td>";
			$rcHtml[] = "		<td class='$sbEstilo'>";
			$rcHtml[] = doSelect($rcTipoIni, 'rutainitars', $rcTmp['rutainitars'],$sbChangeStyle);
			$rcHtml[] = "		</td>";
			$rcHtml[] = "<td class='$sbEstilo' align='center'>";
			if($rcTmp["rutacantien"]){
				//se distribuyen los segundos en dias horas.
				//cuantas horas hay.
				$rcTmp["rutacantien_h"] = (int) (floor((fmod($rcTmp["rutacantien"], $objDate->nuSecsDay))))/$objDate->nuSecsHour;
				//cuantos dias hay 
				$rcTmp["rutacantien"] = (int) floor ($rcTmp["rutacantien"]/$objDate->nuSecsDay);
				$rcHtml[] = "	<input type='hidden' name='visible' value='1'>";
				$rcHtml[] = "<div id='".$sbDivId."' align='center'>";
			}else{
				$rcHtml[] = "	<input type='hidden' name='visible' value='0'>";
				$rcHtml[] = "<div id='".$sbDivId."' align='center' style=\"visibility:hidden;display:'none';height:0\">";
			}
			$rcHtml[] = "<table>";
			$rcHtml[] = "<tr>";
			$rcHtml[] = "<td class='$sbEstilo' align='center'>";
			$rcHtml[] = "<input type='text' name='rutacantien' id='rutacantien' onkeypress=\"isInteger(event);\" size='3' maxlength='3' value=\"".$rcTmp["rutacantien"]."\" onchange=\"if(this.value){changeStyle('".$sbForm."');}\">";
			$rcHtml[] = "</td>";
			$rcHtml[] = "<td class='$sbEstilo' align='center'>";
			$rcHtml[] = "<input type='text' name='rutacantien_h' id='rutacantien_h' onkeypress=\"isInteger(event);\" size='2' maxlength='2' value=\"".$rcTmp["rutacantien_h"]."\" onchange=\"if(this.value){changeStyle('".$sbForm."');}\">";
			$rcHtml[] = "</td>";
			$rcHtml[] = "</tr>";
			$rcHtml[] = "</table>";
			$rcHtml[] = "</div>";	
			$rcHtml[] = "</td>";
			$rcRutaRegla = $objGateway->getRutaReglas($rcTmp['rutacodigon']);
			$rcHtml[] = "		<td>";
			$rcHtml[] = doSelectMultiple($rcIndexReglas, 'reglas', $rcRutaRegla, $sbChangeStyle,null);
			$rcHtml[] = "		</td>";
				
			$rcHtml[] = "		<td class='$sbEstilo'>";
			$onClickAdd = $sbErrors."UpdateRuta('{$rcTmp['rutacodigon']}'," .
													"'$proceso__proccodigos'," .
													"document.".$sbForm.".tarecodigos.value, " .
													"document.".$sbForm.".rutaesactas.value, " .
													"document.".$sbForm.".rutatarsigs.value," .
													"document.".$sbForm.".rutainitars.value, 
													 document.".$sbForm.".rutacantien.value,
													 document.".$sbForm.".rutacantien_h.value,
													 document.".$sbForm.".reglas, " .
													"errores, '".$sbForm."');";
			$rcHtml[] = "			<img src='web/images/actualizar_002.gif' border='0' alt=\"".$rclabels_crl["CmdUpdate"]."\" title=\"".$rclabels_crl["CmdUpdate"]."\" onClick=\"$onClickAdd\" >";
			$onClickAdd = $sbErrors."DeleteRuta('$proceso__proccodigos',document.".$sbForm.".rutacodigon.value, errores);";
			$rcHtml[] = "			<img src='web/images/borrar.gif' border='0' alt=\"".$rclabels_crl["CmdDelete"]."\" title=\"".$rclabels_crl["CmdDelete"]."\" onClick=\"$onClickAdd\">";
			$rcHtml[] = "		</td>";
			$rcHtml[] = "	</tr>";
			$rcHtml[] = "</form>";
		};
	}

	//Adiciona ruta si es necesario
	if ($newruta) {
		$sbForm = "frmNewRuta";
		$sbDivId = "rutacantien_0_div";
		$sbJs = "onchange=\"jsViewPercent('".$sbForm."','".$sbDivId."','".$sbProcesoIni."');\"";
		$rcHtml[] = "<form name='frmNewRuta' method='post'>";
		$rcHtml[] = "	<input type='hidden' name='proccodigos' value='$proceso__proccodigos'>";
		$rcHtml[] = "	<tr>";
		$rcHtml[] = "		<td>";
		$sbChange = "onchange=\"if(this.value){"."LoadSelect('estadotarea','tarecodigos',Array(this),this.form.rutaesactas,'rutaesactas');"."loadrutatarsigs(this.form.tarecodigos, this.form.rutatarsigs, this.form.tarecodigos.value);"."}\"";
		$rcHtml[] = doSelect($rcIndexTareas, 'tarecodigos', null, $sbChange, null, true,'resaltar');
		$rcHtml[] = "		</td>";
		$rcHtml[] = "		<td>";
		$rcHtml[] = doSelect($rcIndexEstados[$rcTmp['tarecodigos']], 'rutaesactas', null, $sbJs, null, true,'resaltar');
		$rcHtml[] = "		</td>";
		$rcHtml[] = "		<td>";
		$rcHtml[] = doSelect($rcIndexTareas, 'rutatarsigs', null, $sbJs, $rcTmp['tarecodigos'],true,'resaltar');
		$rcHtml[] = "		</td>";
		$rcHtml[] = "		<td>";
		$rcHtml[] = doSelect($rcTipoIni, 'rutainitars',null,$sbJs,null,true,'resaltar');
		$rcHtml[] = "		</td>";
		$rcHtml[] = "<td class='$sbEstilo' align='center'>";
		$rcHtml[] = "<input type='hidden' name='visible' value='0'>";
		$rcHtml[] = "<div id='rutacantien_0_div' align='center' style=\"visibility:hidden;display:'none';height:0\">";
		$rcHtml[] = "<table>";
		$rcHtml[] = "<tr>";
		$rcHtml[] = "<td class='$sbEstilo' align='center'>";
		$rcHtml[] = "<input type='text' name='rutacantien' id='rutacantien' onkeypress=\"isInteger(event);\" size='3' maxlength='3' value='' class='resaltar'>";
		$rcHtml[] = "</td>";
		$rcHtml[] = "<td class='$sbEstilo' align='center'>";
		$rcHtml[] = "<input type='text' name='rutacantien_h' id='rutacantien_h' onkeypress=\"isInteger(event);\" size='2' maxlength='2' value='' class='resaltar'>";
		$rcHtml[] = "</td>";
		$rcHtml[] = "</tr>";
		$rcHtml[] = "</table>";
		$rcHtml[] = "</div>";
		$rcHtml[] = "</td>";
		$rcHtml[] = "		<td>";
		$rcHtml[] = doSelectMultiple($rcIndexReglas, 'reglas', null, null,'resaltar');
		$rcHtml[] = "		</td>";
		$rcHtml[] = "		<td>";
		$onClickAdd = $sbErrors."AddRuta('$proceso__proccodigos'," .
												"document.frmNewRuta.tarecodigos.value, " .
												"document.frmNewRuta.rutaesactas.value, " .
												"document.frmNewRuta.rutatarsigs.value," .
												"document.frmNewRuta.rutainitars.value, 
												document.frmNewRuta.rutacantien.value,
												document.frmNewRuta.rutacantien_h.value,
												document.frmNewRuta.reglas, " .
												"errores);";
		$rcHtml[] = "			<img src='web/images/insertar.gif' border='0' alt=\"".$rclabels_crl["CmdSave"]."\" href='#' title=\"".$rclabels_crl["CmdSave"]."\" onClick=\"$onClickAdd\">";
		$rcHtml[] = "		</td>";
		$rcHtml[] = "	</tr>";
		$rcHtml[] = "</form>";
	}
	$rcHtml[] = "</table>";
	return implode("\n", $rcHtml);
}

//arma los combos
function doSelect($rcLista, $name, $valor = null, $extra = null, $exclude = null, $firstnull = true, $classStyle=null) {
	if($classStyle)
	$style = "class='$classStyle'";
	$rcHtml[] = "<select name='$name' $extra $style>";
	if ($firstnull)
	$rcHtml[] = "<option value=''>---</optional>";
	if(is_array($rcLista)){
		foreach ($rcLista as $value => $label) {
			if ($value != $exclude) {
				$rcHtml[] = "<option value='$value'";
				if ($value == $valor)
				$rcHtml[] = " selected>$label</optional>";
				else
				$rcHtml[] = ">$label</optional>";
			}
		}
	}
	$rcHtml[] = "</select>";
	return implode("\n", $rcHtml);
}

function doSelectMultiple($rcLista, $name, $rcValor = null, $extra = null,$classStyle=null) {
	if($classStyle)
	$style = "class='$classStyle'";

	$rcHtml[] = "<select name='$name' size='3' multiple $extra $style>";
	$rcHtml[] = "<option value=''></optional>";
	if(is_array($rcLista)){
		foreach ($rcLista as $value => $label) {
			if ($value != $exclude) {
				$rcHtml[] = "<option value='$value'";
				if (is_array($rcValor)){
					if(in_array($value,$rcValor))
					$rcHtml[] = " selected>$label</optional>";
					else
					$rcHtml[] = ">$label</optional>";
				}else
				$rcHtml[] = ">$label</optional>";
			}
		}
	}
	$rcHtml[] = "</select>";
	return implode("\n", $rcHtml);
}
?>