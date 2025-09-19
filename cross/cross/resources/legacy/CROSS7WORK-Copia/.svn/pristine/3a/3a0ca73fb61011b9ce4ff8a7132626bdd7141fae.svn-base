<?php
/**Copyright 2005 FullEngine

consulta y pinta la informacion de los dealers a ser aprobados para liquidacion
@author freina <freina@parquesoft.com>
@date 01-Mar-2005 13:55
@location Cali - Colombia
*/
function smarty_function_viewListaGenerica($params,&$smarty)
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
	
	//Obtiene la data de los leader del datamart
	$rcData = getData($sbTabla,$sqlid);
	
	if($rcData)
	{
		//encabezado
		//se obtienen los labels
		include ($rcUser["lang"]."/".$rcUser["lang"].".".strtolower($sbTabla).".php");
		include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
		
		$Pager = Application::loadservices("Pager");
		$Date = Application::loadServices("DateController");
		$sbHtml .= $Pager->paginar($rcData,$sbTabla);
		
		$sbModulePref = Application::getAppId();
		$rcLlave = explode(",",$sbLlave);
		$rcLabel = explode(",",$sbLabel);
			
		//Pinta la tabla
		$sbHtml .= "<table border=0 width=60% align='center'><tr>";
		foreach ($rcLlave as $nuCont=>$sbKey)
			$sbHtml .= "<td class='titulofila'>".$rclabels[$sbKey]["label"]."</td>\n";
		if($sbLabel)
			foreach ($rcLabel as $nuCont=>$sbLabel)
				$sbHtml .= "<td class='titulofila'>".$rclabels[$sbLabel]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila' align=center colspan=2><strong>".$rclabels_generic['acciones']."</strong></td>\n";
		$sbHtml .= "</tr>\n";
		
		foreach ($rcData as $nuCont => $rcRow)
		{
			if (fmod($nuCount,2)==0)
				$sbEstilo = "celda";
			else
				$sbEstilo = "celda2";
			$sbHtml .= "<tr>\n";
			
			foreach ($rcRow as $sbKey=>$sbVal)
			{
				if(strstr($sbLlave,$sbKey))
				{
					$sbHtml .= "<td class='".$sbEstilo."'>".$sbVal."</td>"."\n";
					$sbRequest .= "&".strtolower($sbTabla)."__".$sbKey."=".$sbVal;
				}
			}
			if($sbLabel)
			{
				foreach ($rcLabel as $sbKey=>$sbLabel)
				{
					if(strstr($dateFields,$sbLabel))
						$sbHtml .= "<td class='".$sbEstilo."'>".$Date->fncformatofecha($rcRow[$sbLabel])."</td>"."\n";
					else
						$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow[$sbLabel]."</td>"."\n";
				}
			}
			//PANEL DE ACCIONES
			//EDITAR
			$sbHtml .= "<td class='".$sbEstilo."' align=center>".
			"<a href='index.php?action=".$sbModulePref."CmdShowById".$sbTabla.$sbRequest.
			"'><img border=0 src=web/images/editar.gif title='".$rclabels_generic['editar']."'></a></td>\n";
			
			//ELIMINAR
			$sbJs = "var result = confirm('{$rcMsg["delete"]}'); if(result == true){document.location='index.php?action=".$sbModulePref."CmdDelete".$sbTabla.$sbRequest."';disableButtons()}";
			$sbHtml .= "<td class='$sbEstilo' align=center>\n<a href=# onclick=\"".$sbJs."\">";
			$sbHtml .= "<img src=web/images/ico_basura.gif border=0 title='".$rclabels_generic['eliminar']."'></a></td>\n";
			
			$sbHtml .= "</tr>";
			$nuCount++;
		}
		return $sbHtml;
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

function getData($sbTabla,$sqlid=false)
{
	if($sqlid)
	{
		$objData = Application::getDataGateway("sqlExtended");
		$rcData = $objData->getDataCombo($sqlid);
	}
	else 
	{
		$objData = Application::getDataGateway($sbTabla);		
		$sbFuncion = "getAll".$sbTabla;
		$rcData = $objData->$sbFuncion();
	}
	return $rcData;
}
?>