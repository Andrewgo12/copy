<?php  
/**Copyright 2004 ï¿½ FullEngine
	
	 Consulta y pinta las tareas asignadas a un ente organizacional
	@author creyes <cesar.reyes@parquesoft.com>
	@date 01-sep-2004 11:08:26
	@location Cali - Colombia
*/

function smarty_function_viewDataOrder($params, & $smarty) {
	extract($_REQUEST);
	extract($params);

	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) 
	{
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
	include ($rcUser["lang"]."/".$rcUser["lang"].".schedule.php");

	//Cargamos algunas constantes y parámetros
	$objService = Application :: loadServices("General");
	$rcTmp = $objService->getParam("human_resources", "acceso_total",false);
	$rcVizOrden = $objService->getParam("schedule", "NIVELES_VIZ_ORDEN");
	
	$objdate = Application :: loadServices("DateController");
	$now = $objdate->fncintdate();

	//CONSTANTES Y PARÁMETROS
	$rcValoresOpciones = Application::getConstant("VIZ_OPC");

	//Personal
	$objService = Application :: loadServices("Human_resources");
	$rcPersDatos = $objService->getPersDatos($rcUser["username"], true);
	
	//Ente Organizacional logueado
	$perscodigos = $rcPersDatos["perscodigos"];
	$orgacodigos = $objService->getOrgacodigosByPersonal($perscodigos);
	$objService->close();

	//obtiene los datos de expedientes, ordenes y actas, dependiendo de las opciones configuradas para esta implementación
	$objSchedule = Application::getDomainController("ScheduleManager");
	$objSchedule->rcVizParam = $rcVizOrden;
	$objSchedule->getDataOrder($rcValoresOpciones,$orgacodigos);
	
	if(is_array($objSchedule->rcOrdenes))
		foreach ($objSchedule->rcOrdenes as $rcRow)
			$objSchedule->rcActas[$rcRow["ordenumeros"]] = array($rcRow["actacodigos"],$rcRow["tarecodigos"],$rcRow["tarenombres"]);
	
	$rcDataOrder[$rcValoresOpciones["VER_ORD"]] = $objSchedule->rcOrdenes;
	$rcDataOrder[$rcValoresOpciones["VER_ACT"]] = $objSchedule->rcActas;
	
	//COMBO DE CASOS
	if(in_array($rcValoresOpciones["VER_ORD"],$objSchedule->rcVizParam))
		$rcHtml[] = getComboBoxOrdenes($rclabels["ordenumeros"]["label"],"ordenumeros",$_REQUEST["ordenumeros"],$objSchedule->rcActas,$rclabels["acta"]["label"],"tarenombres");
    return implode("\n",$rcHtml);
}

function getComboBoxOrdenes($sbLabel,$name,$value,$rcOrdenes,$sbLabelTarea,$nameTarea)
{
	settype($sbHtml,"string");
	settype($sbOrdenes,"string");
	settype($sbAux,"string");
	$objDate = Application::loadServices("DateController");
	
	$sbHtml = "<tr><td>".$sbLabel."</td>";
	
	if(is_array($rcOrdenes))
	{
		//Exped1=>orden1,orden2,orden3___Exped2=>orden4,orden5___Exped3=>orden6
		$sbAux = '';
		foreach ($rcOrdenes as $sbOrdenumeros=>$rcActa)
		{
			if($sbOrdenumeros != $sbAux)
			{
				if($sbActas == '')
					$sbActas .= $sbOrdenumeros;
				else 
					$sbActas .= "___".$sbOrdenumeros;
			}
			$nuCont=0;
			$sbAux = $sbOrdenumeros;
			$sbSelected = "";
			$sbActas .= "=>".join("=>",$rcActa);
			if($value == $sbOrdenumeros)
				$sbSelected = " selected";
			$sbOptions .= "<option value='".$sbOrdenumeros."' ".$sbSelected.">".$sbOrdenumeros."</option>";
		}
	}
	$sbHtml .= "<td><select name='$name' onChange='loadActas(this.value,\"".$sbActas."\");'>";
	$sbHtml .= "\t<option value=''>---</option>";
	$sbHtml .= $sbOptions;
	$sbHtml .= "</select>"."</td><td>&nbsp;</Td></tr>";
	
	$sbHtml .= "<input type='hidden' name='actacodigos'>";
	$sbHtml .= "<tr><td>".$sbLabelTarea."</Td>";
	$sbHtml .= "<td><input type='text' size=40 readonly name='$nameTarea'>";
	$sbHtml .= "</td><td>&nbsp;</Td></tr>";
	
	if(strlen($value))
		$sbHtml .= "<script>loadActas(\"$value\",\"".$sbActas."\");</script>";
	return $sbHtml;
}
?>