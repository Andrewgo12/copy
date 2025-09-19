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
function smarty_function_showCompromisos($params, & $smarty) {

	extract($params);
	settype($sbvalue,"string");
	settype($sbName,"string");
	settype($sbAccessKey,"string");
	settype($nucont,"integer");

	//se extrae la data de las actividades
	if($_REQUEST["acemcompromis"]){
		$rctmpa = frcExplode($_REQUEST["acemcompromis"]);
	}
	//Trae los datos del usuario
	$serviceDate = Application :: loadServices("DateController");
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
	$rcCompActa = $gatewayActivi->getAllCompromisoActa($_REQUEST['acta']);
	$rcCompromisos = $gatewayActivi->getAllCompromiso();

	//Acomoda las actividades con el nombre
	if(is_array($rcCompromisos)){
		foreach($rcCompromisos as $rcTmp)
			$rcLabelActivi[$rcTmp["compcodigos"]] = $rcTmp["compdescris"];
	}
	$rcHtml[] = "<table border='0' align='left' width='80%'>";
	$rcHtml[] = "<tr><th colspan='2'><div align='left'>".$rclabels["compromisos"]["label"]."</div></th></tr>";
	$rcHtml[] = "<tr><td colspan='2'><div align='left'>".$rclabels["compromisos"]["commentary"]."</div></td></tr>";
	$rcHtml[] = "<tr><th colspan='2'><div align='left'>&nbsp;</div></th></tr>";
	
	//Pinta el combo que adiciona
	$sbCombo = getComboCompromisos($rcCompromisos,$rctmpa, "cmbOriginal");
	$sbCalendar = getCalendar($id="accofecrevn",$serviceDate,$form);
	$rcHtml[] = "<tr>" .
	"		<td>$sbCombo</td>" .
	"		<td>$sbCalendar</td>" .
	"		<td><a href='#' onClick=\"if(".$form.".accofecrevn.value!=''){".$form.".action.value='FeCrCmdAddCompromisoActa';$form.submit();}\" ><img src='web/images/positivo_002.gif' border='0' align='middle' title=\"".$rclabels["add"]["label"]."\"></a></td>" .
	" 	</tr>";

	$rcHtml[] = "<tr><td class='piedefoto'><hr></tr>";
	
	//Pinta las opcionaes ya selecionadas
	if ($rctmpa)
	{
		//Pone los emcabezados
		$rcHtml[] = "<tr>" .
		"		<td class='titulofila'>".$rclabels["compromisos"]["label"]."</td>" .
		"		<td class='titulofila'>".$rclabels["fecha"]["label"]."</td>" .
		"		<td class='titulofila'>".$rclabels["acciones"]["label"]."</td>" .
		" 	</tr>";
		$rows = 0;
		foreach($rctmpa as $compcodigos => $accofecrevn)
		{
			//Calcula el interlineado
			if (($rows % 2) == 0)
				$estilo = "celda";
			else
				$estilo = "celda2";
			$rcHtml[] = "<tr>" .
			"		<td class='$estilo'>".$rcLabelActivi[$compcodigos]."</td>" .
			"		<td class='$estilo'>".$serviceDate->fncformatofechahora($accofecrevn)."</td>" .
			"		<td class='$estilo'>" .
			"			<a href='#' onClick=\"$form.action.value='FeCrCmdDeleteCompromisoacta';$form.delacemcompromis.value='$compcodigos';$form.submit();\"><img src='web/images/borrar.gif' border='0' align='middle' title=\"".$rclabels["del"]["label"]."\"></a>" .
			"       </td>" .
			" 	</tr>";
			$rows++;
		}
	}
	$rcHtml[] = "</table>";
	return implode("\n", $rcHtml);
}

function getComboCompromisos($rcActividades, $rcSelected,$nameCombo, $selected = null) {
	if (!is_array($rcActividades))
		return null;
	if (!is_array($rcSelected))
		$rcSelected = array();
	$rcHtml[] = "<select name='".$nameCombo."[]' multiple size=7>";
	$rcHtml[] = "\t<option value=''>---</option>";
	foreach ($rcActividades as $rcTmp) 
	{
		if(!array_key_exists($rcTmp["compcodigos"],$rcSelected))
		{
			$sbHtml = "\t<option value='".$rcTmp["compcodigos"]."'";
			if($rcTmp["compcodigos"] == $selected)
			$sbHtml .= " selected ";
			$sbHtml .= ">".$rcTmp["compdescris"]."</option>";
			$rcHtml[] = $sbHtml;
		}
	}
	$rcHtml[] = "</select>";
	return implode("\n",$rcHtml);
}

function getCalendar($id,$serviceDate,$form_name)
{
	$imgPath = "web/images/calendar.gif";
	$rcuser = Application :: getUserParam();
	$nufecha = $serviceDate->fncintdatehour();
	$sbformato = $serviceDate->sbformat_date_time;
	$maxlength = 19;
	$sbfecha = $serviceDate->fncformatofechahora($nufecha);
	$size = 20;
	$sbid=" id='$id' ";
	$name = $id;

    include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
	$sbhtml_result = "<input type=text name='$name' size='$size' $sbid  maxlength='$maxlength' ";
	if ($_REQUEST[$name] !== null) { //Si la fecha viene en el request
        if(is_numeric($_REQUEST[$name])){ //Si esta en formato timestamp
            if($hour == "true"){ // esta definido con horas
                $_REQUEST[$name] = $serviceDate->fncformatofechahora($_REQUEST[$name]);
            }else{
                $_REQUEST[$name] = $serviceDate->fncformatofecha($_REQUEST[$name]);
            }
        }
		$sbhtml_result .= "value='".$_REQUEST[$name]."'";
	} else {
		$sbhtml_result .= "value=''";
	}
	$sbhtml_result .= " onBlur=\"if(this.value){var Tentativa = new Date(this.value);
                                if(isNaN(Tentativa)){
                                    alert('".$rcmessages[7]."');
                                    this.value = '';
                                    this.focus();
                                }}\">";
	if(isset($hour))	
		$horas = "cal1.time_comp = true;";
	else 
		$horas = "cal1.time_comp = false;";
	
	$sbhtml_result .= "<a href=\"#\" onclick=\"javascript:var Tentativa = new Date(document.forms['$form_name'].elements['$name'].value); 
                                                if(!isNaN(Tentativa) || document.forms['$form_name'].elements['$name'].value==''){
                                                    var cal1 = new calendar1(document.forms['$form_name'].elements['$name']);
                                                    cal1.year_scroll = true;
                                                    cal1.style='".$rcuser["style"]."';
                                                    $horas
                                                    cal1.format_date = '".$serviceDate->calendarFormat."';
                                                    cal1.language = '".$rcuser["lang"]."';
                                                    cal1.first_day = 'Su';
                                                    cal1.popup();
                                                }else{
                                                    alert('".$rcmessages[7]."');
                                                    document.forms['$form_name'].elements['$name'].value = '';
                                                    document.forms['$form_name'].elements['$name'].focus();
                                                }\">".
                        "<img src='$imgPath' border='0' align='absmiddle'></a>";	
	return $sbhtml_result;
}

    function frcExplode($acemcompromis)
    {
    	if(strpos($acemcompromis,"_FILA_")!==false)
    	{
    		$rcTmp = explode("_FILA_",$acemcompromis);
	    	foreach ($rcTmp as $value)
	    	{
	    		$rcTmp2 = explode("_COL_",$value);
	    		$rcReturn[$rcTmp2[0]] = $rcTmp2[1];
	    	}
    	}
    	elseif(strpos($acemcompromis,"_COL_")!==false)
    	{
    		$rcTmp2 = explode("_COL_",$acemcompromis);
	    	$rcReturn[$rcTmp2[0]] = $rcTmp2[1];
    	}
    	return $rcReturn;
    }
?>