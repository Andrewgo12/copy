<?php  
/**
* @Copyright 2004 � FullEngine
*
* Smarty plugin
* Pinta el listado de ordenes
* @author creyes <cesar.reyes@parquesoft.com>
* @date 09-dic-2004 10:26:01
* @location Cali - Colombia
*/
function smarty_function_viewListadoCasosLog($params, & $smarty)
{
	extract($_REQUEST);
	extract($params);
	if(!$listaCasos)
		return false;
		
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser))
	{
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}
	$objGateway = Application::getDataGateway("sqlExtended");
	$listaCasos = str_replace(",","','",$listaCasos);
	$rcData = $objGateway->getListadoCasosFichas($listaCasos);
	
	if ($rcData) 
	{
		//Trae las etiquetas
		include ($rcUser["lang"]."/".$rcUser["lang"].".listadocasoslog.php");
		include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

		//se pinta el registro
		$sbHtml .= "<tr>";
		$sbHtml .= "<td colspan=3 class='piedefoto'>";
		$objDate = Application::loadServices("DateController");
		$sbActive = Application::getConstant("REG_ACT");
		
		$sbHtml .= "<table border=0 width=80% align='center'>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["ordenumeros"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center>".$rclabels["ordeobservs"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center><strong>".$rclabels['acciones']["label"]."</strong></td>\n";
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
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["ordeobservs"]."</td>"."\n";
			

			//PANEL DE ACCIONES
			//VER FICHA
			$sbHtml .= "<td class='".$sbEstilo."'><a href='#' title='".$rclabels_generic["view_r"]."' onClick=\"javascript:fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadFicha&mainFrame=FeCrCmdDefaultBodyFichaOrd&orden__ordenumeros=".$rcRow["ordenumeros"]."&vars=orden__ordenumeros');\" ><img src='web/images/consultar_002.gif' border='0' alt='".$rclabels_generic["view_r"]."'></a></td>";
	
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
