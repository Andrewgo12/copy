<?php
/**Copyright 2005 FullEngine

consulta y pinta la informacion de los dealers a ser aprobados para liquidacion
@author freina <freina@parquesoft.com>
@date 01-Mar-2005 13:55
@location Cali - Colombia
*/
function smarty_function_viewConsultaCitas($params,&$smarty)
{
	extract($_REQUEST);
	extract($params);
	
	//Vienen sbTabla,sbLlave,sbLabel
	settype($objDomain, "object");
	settype($rcUser, "array");
	settype($rcRow, "array");
	settype($rcCandidatos, "array");
	settype($sbHtml, "string");
	settype($sbEstilo, "string");
	settype($sbRequest, "string");
	settype($nuCount, "integer");
	
	$rcUser = getDataUser();
	include ($rcUser["lang"]."/".$rcUser["lang"].".citaswebconsult.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
		
	if($consulta && !$contcodigon) {
		echo "<script>alert('".$rcmessages[0]."');</script>";
		return null;
	}
	if(!$consulta)
		return null;
	
	//Obtiene la data de los leader del datamart
	$rcData = getData($contcodigon,$preecodigon);
	
	//Entes organizacionales
	$rcOrga = getRRHH();
	
	//Estados entrada
	$rcEstados = getEstados();
	
	if($rcData)
	{
		$Pager = Application::loadservices("Pager");
		$Date = Application::loadServices("DateController");
		if($rcData[0])
			$nuSize += sizeof($rcData[0]);
		if($rcData[1])
			$nuSize += sizeof($rcData[1]);
		$sbHtml .= $Pager->paginar($rcData,$sbTabla,false,$nuSize);
		
		$sbModulePref = Application::getAppId();
			
		if(is_array($rcData[0]))
		{
			//Pinta la tabla
			$sbHtml .= "<table border=0 width=60% align='center'><tr>";
			$sbHtml .= "<td class='titulofila'>".$rclabels["preecodigon"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["entrcodigon"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["orgacodigos"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["entrfechorun"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["entrduracion"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["preedescris"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["entrdescris"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["entractivas"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila' align=center colspan=2><strong>".$rclabels_generic['acciones']."</strong></td>\n";
			$sbHtml .= "</tr>\n";
			
			foreach ($rcData[0] as $nuCont => $rcRow)
			{
				if (fmod($nuCount,2)==0)
					$sbEstilo = "celda";
				else
					$sbEstilo = "celda2";
				$sbHtml .= "<tr>\n";
				
				$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["preecodigon"]."</td>"."\n";
				$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["entrcodigon"]."</td>"."\n";
				$sbHtml .= "<td class='".$sbEstilo."'>".$rcOrga[$rcRow["orgacodigos"]]."</td>"."\n";
				$sbHtml .= "<td class='".$sbEstilo."'>".$Date->fncformatofechahora($rcRow["entrfechorun"])."</td>"."\n";
				$sbHtml .= "<td class='".$sbEstilo."'>".$Date->fncformatofechahora($rcRow["entrduracion"])."</td>"."\n";
				if($sbActive == $rcRow["entractivas"])
					$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["preedescris"]."</td>"."\n";
				else {
					$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["preedescris"]."</td>"."\n";
					$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["entrdescris"]."</td>"."\n";
				}
				$sbHtml .= "<td class='".$sbEstilo."'>".$rcEstados[$rcRow["entractivas"]]."</td>"."\n";
				$sbRequest .= "&entrcodigon=".$rcRow["entrcodigon"];
	
				//PANEL DE ACCIONES
				//ELIMINAR
				$sbJs = "var result = confirm('{$rcMsg["delete"]}'); if(result == true){document.location='index.php?action=FeScCmdDeleteEntradaWeb".$sbRequest."';disableButtons()}";
				$sbHtml .= "<td class='$sbEstilo' align=center>\n<a href=# onclick=\"".$sbJs."\">";
				$sbHtml .= "<img src=web/images/ico_basura.gif border=0 title='".$rclabels_generic['eliminar']."'></a></td>\n";
				
				$sbHtml .= "</tr>";
				$nuCount++;
			}
		}
		if(is_array($rcData[1]))
		{
			//Pinta la tabla
			$sinProg = $rclabels["SINPROG"]["label"];
			$sbHtml .= "<table border=0 width=60% align='center'><tr>";
			$sbHtml .= "<td class='titulofila'>".$rclabels["preecodigon"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["preedescris"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila'>".$rclabels["entractivas"]["label"]."</td>\n";
			$sbHtml .= "<td class='titulofila' align=center colspan=2><strong>".$rclabels_generic['acciones']."</strong></td>\n";
			$sbHtml .= "</tr>\n";
			
			foreach ($rcData[1] as $nuCont => $rcRow)
			{
				if (fmod($nuCount,2)==0)
					$sbEstilo = "celda";
				else
					$sbEstilo = "celda2";
				$sbHtml .= "<tr>\n";
				
				$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["preecodigon"]."</td>"."\n";
				$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["preedescris"]."</td>"."\n";
				$sbHtml .= "<td class='".$sbEstilo."'>".$sinProg."</td>"."\n";
				$sbRequest .= "&entrcodigon=".$rcRow["preecodigon"];
	
				//PANEL DE ACCIONES
				//ELIMINAR
				$sbJs = "var result = confirm('{$rcMsg["delete"]}'); if(result == true){document.location='index.php?action=FeScCmdDeletePreentrada".$sbRequest."';disableButtons()}";
				$sbHtml .= "<td class='$sbEstilo' align=center>\n<a href=# onclick=\"".$sbJs."\">";
				$sbHtml .= "<img src=web/images/ico_basura.gif border=0 title='".$rcMsg['delete']."'></a></td>\n";
				
				$sbHtml .= "</tr>";
				$nuCount++;
			}
		}
		return $sbHtml;
	}
	else {
		echo "<script>alert('".$rcmessages[33]."');</script>";
		return null;
	}
}

/**
*   Propiedad intelectual del FullEngine.
*   Obtiene la data de usuario
*  @author  freina
*	@return array $orcresult (Array con la data del usuario o null)
*   @date 01-Mar-2005 14:04
*   @location Cali-Colombia
*/
function getDataUser()
{
	settype($orcResult, "array");
	
	//Trae los datos del usuario
	$orcResult = Application :: getUserParam();
	if (!is_array($orcResult))
	{
		//Si no existe usuario en sesion
		$orcResult["lang"] = Application :: getSingleLang();
	}
	return $orcResult;
}

function getData($contcodigon,$preecodigon)
{
	$objData = Application::getDataGateway("sqlExtended");
	$rcProg = $objData->getCitasProgramadasById($contcodigon,$preecodigon);
	if(!is_array($rcProg))
		$rcProg = false;
		
	$rcNoProg = $objData->getCitasSinProgramarById($contcodigon,$preecodigon);
	if(!is_array($rcNoProg))
		$rcNoProg = false;
		
	if(!is_array($rcProg) && !is_array($rcNoProg))
		return false;
		
	$rcData = array($rcProg,$rcNoProg);
	return $rcData;
}

function getRRHH()
{
	$objHR = Application::loadServices("Human_resources");
	$rcOrga = $objHR->getActiveEntesOrg();
	if(!is_array($rcOrga))
		return false;
	foreach ($rcOrga as $rcRow)
		$rcResult[$rcRow["orgacodigos"]] = $rcRow["organombres"];
	return $rcResult;
}

function getEstados()
{
	$gateWay = Application::getDataGateway("sqlExtended");
	$rcTmp = $gateWay->getEstadosEntrada();
	if(!is_array($rcTmp))
		return false;
	foreach ($rcTmp as $rcRow)
		$rcResult[$rcRow["esencodigos"]] = $rcRow["esennombres"];
	return $rcResult;
}
?>