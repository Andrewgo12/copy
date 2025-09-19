<?php  
/**
* @Copyright 2004 ï¿½ FullEngine
*
* Smarty plugin
* Pinta el listado de ordenes
* @author creyes <cesar.reyes@parquesoft.com>
* @date 09-dic-2004 10:26:01
* @location Cali - Colombia
*/
function smarty_function_viewListadoSeguimientos($params, & $smarty)
{
	extract($_REQUEST);
	extract($params);
	if(!$consult__flag)
		return false;
		
	//Enviroment
	$rcEnvir = $_REQUEST;


	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser))
	{
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}
	$objGateway = Application::getDataGateway("compromisoExtended");
	$objGateway->setData($rcEnvir);
	$objGateway->getListadoSeguimientos();
	$rcData = $objGateway->getResult();
	
	if ($rcData) 
	{
		//Trae las etiquetas
		include ($rcUser["lang"]."/".$rcUser["lang"].".listadoseguimientos.php");
		include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

		//se pinta el registro
		$sbHtml .= "<tr>";
		$sbHtml .= "<td colspan=3 class='piedefoto'>";
		$objDate = Application::loadServices("DateController");
		$sbActive = Application::getConstant("REG_ACT");
		
		//Data tablas tipo
		$rcInfractores = getData("infractor","infrcodigos","infrnombres");
		$rcTipoCaso = getData("tipoorden","tiorcodigos","tiornombres");
		$rcEventos = getDataEventos("evento","tiorcodigos","evencodigos","evennombres");
		$rcCausas = getDataCausas("causa","tiorcodigos","evencodigos","causcodigos","causnombres");
		$rcDependencias = getData("organizacion","orgacodigos","organombres");
		$rcLocalidades = getData("localizacion","locacodigos","locanombres");
		$rcCompromisos = getData("compromiso","compcodigos","compdescris");
		$rcEstadosComp = Application::getConstant("ACCOACTIVAS");

		//Pinta la tabla
		//No. de caso, fecha de registro, Vencimiento de compromisos, Infractor, tipo, Clasificación, Subclasificación, Dependencia, Localización, Listado de compromisos, Estado del compromiso
		$sbHtml .= "<table border=0 width=80% align='center'>";
		
		$objExcel = Application::getDomainController('ExcelManager');
		$rcFilaLabels = array($rclabels["ordenumeros"]["label"],$rclabels["ordefecregd"]["label"],$rclabels["accofecrevn"]["label"],$rclabels["infrcodigos"]["label"],$rclabels["tiorcodigos"]["label"],$rclabels["evencodigos"]["label"],$rclabels["causcodigos"]["label"],$rclabels["orgacodigos"]["label"],$rclabels["locacodigos"]["label"],$rclabels["compcodigos"]["label"],$rclabels["accoobservas"]["label"],$rclabels["accoactivas"]["label"]);
		foreach ($rcData as $nuCont => $rcRow)
		{
			$rcConsult[] = array($rcRow["ordenumeros"],$objDate->fncformatofechahora($rcRow["ordefecregd"]),$objDate->fncformatofechahora($rcRow["accofecrevn"]),
					$rcInfractores[$rcRow["infrcodigos"]],$rcTipoCaso[$rcRow["tiorcodigos"]],$rcEventos[$rcRow["tiorcodigos"]][$rcRow["evencodigos"]],
					$rcCausas[$rcRow["tiorcodigos"]][$rcRow["evencodigos"]][$rcRow["causcodigos"]],$rcDependencias[$rcRow["orgacodigos"]],$rcLocalidades[$rcRow["locacodigos"]],
					$rcCompromisos[$rcRow["compcodigos"]],$rcRow["accoobservas"],$rcEstadosComp[$rcRow["accoactivas"]]);
		}
		reset($rcData);
		$sbHtml .= "<tr><td>".$objExcel->execute($rcFilaLabels,$rcConsult)."</td><td colspan=13><B>".sizeof($rcConsult)." ".$rclabels_generic["rec"]."</B></td></tr>";
	
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["ordenumeros"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["ordefecregd"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["accofecrevn"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["infrcodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["tiorcodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["causcodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["evencodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["orgacodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["locacodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["compcodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["accoobservas"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["accoactivas"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center colspan=2><strong>".$rclabels['acciones']["label"]."</strong></td>\n";
		$sbHtml .= "</tr>\n";

		foreach ($rcData as $nuCont => $rcRow)
		{
			if (fmod($nuCount, 2) == 0)
				$sbEstilo = "celda";
			else
				$sbEstilo = "celda2";
			$sbHtml .= "<tr>\n";

			$sbRequest = "&ordenumeros=".$rcRow["ordenumeros"];
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["ordenumeros"]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$objDate->fncformatofechahora($rcRow["ordefecregd"])."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$objDate->fncformatofechahora($rcRow["accofecrevn"])."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcInfractores[$rcRow["infrcodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcTipoCaso[$rcRow["tiorcodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcEventos[$rcRow["tiorcodigos"]][$rcRow["evencodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcCausas[$rcRow["tiorcodigos"]][$rcRow["evencodigos"]][$rcRow["causcodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcDependencias[$rcRow["orgacodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcLocalidades[$rcRow["locacodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcCompromisos[$rcRow["compcodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["accoobservas"]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcEstadosComp[$rcRow["accoactivas"]]."</td>"."\n";

			//PANEL DE ACCIONES
			//VER FICHA
			$sbHtml .= "<td class='$estilo'><a href='#' title='".$rclabels_generic["view_r"]."' onClick=\"javascript:fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadFicha&mainFrame=FeCrCmdDefaultBodyFichaOrd&orden__ordenumeros=".$rcRow["ordenumeros"]."&vars=orden__ordenumeros');\" ><img src='web/images/consultar_002.gif' border='0' alt='".$rclabels_generic["view_r"]."'></a></td>";
	
			//Sólo casos finalizados pueden tener seguimientos
			if(strlen($rcRow["ordefecfinad"])>0 && $rcRow["accoactivas"]==$sbActive)
				$sbHtml .= "<td><a href='#' title=\"".$rclabels_generic["reg_a"]."\" onClick=\"$form.action.value='FeCrCmdDefaultActaempresa';$form.tarecodigos.value=".$tarecodigos.";$form.orden.value='".$rcRow["ordenumeros"]."';$form.acta.value='".$rcRow["actacodigos"]."';$form.compromiso.value='".$rcRow["compcodigos"]."';$form.orga.value='".$rcRow["orgacodigos"]."';$form.orgacodigos.value='".$rcRow["orgacodigos"]."';$form.acemnumerosupd.value='".$rcRow["acemnumeros"]."';$form.submit();\" ><img src='web/images/editar.gif' border='0' alt=\"".$rclabels_generic["reg_a"]."\" align='absmiddle'></a></td>";
			else
				$sbHtml .= "<td>&nbsp;</td>";
			$sbHtml .= "</tr>";
			$nuCount ++;
		}
		$sbHtml .=  "</table>";
	}
	return $sbHtml;
}

function getData($table,$id,$label)
{
	settype($rcTmp,"array");
	
	$objGateway = Application::getDataGateway($table);
	$sbFunction = "getAll".ucfirst($table);
	$rcData = $objGateway->$sbFunction();
	
	if(!is_array($rcData))
		return false;
	
	foreach ($rcData as $rcRow)
		$rcResult[$rcRow[$id]] = $rcRow[$label];
	return $rcResult;
}

function getDataEventos($table,$id,$id2,$label)
{
	settype($rcTmp,"array");
	
	$objGateway = Application::getDataGateway($table);
	$sbFunction = "getAll".ucfirst($table);
	$rcData = $objGateway->$sbFunction();
	
	if(!is_array($rcData))
		return false;
	
	foreach ($rcData as $rcRow)
		$rcResult[$rcRow[$id]][$rcRow[$id2]] = $rcRow[$label];
	return $rcResult;
}

function getDataCausas($table,$id,$id2,$id3,$label)
{
	settype($rcTmp,"array");
	
	$objGateway = Application::getDataGateway($table);
	$sbFunction = "getAll".ucfirst($table);
	$rcData = $objGateway->$sbFunction();
	
	if(!is_array($rcData))
		return false;
	
	foreach ($rcData as $rcRow)
		$rcResult[$rcRow[$id]][$rcRow[$id2]][$rcRow[$id3]] = $rcRow[$label];
	return $rcResult;
}

?>
