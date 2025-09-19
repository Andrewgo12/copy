<?php
/**Copyright 2005 FullEngine

consulta y pinta la informacion de los dealers a ser aprobados para liquidacion
@author freina <freina@parquesoft.com>
@date 01-Mar-2005 13:55
@location Cali - Colombia
*/
function smarty_function_viewDetalles($params,&$smarty)
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
	$rcData = getDetalles($dimecodigon);
	
	if(!is_array($rcData))
		return false;
	
	//encabezado
	//se obtienen los labels
	include ($rcUser["lang"]."/".$rcUser["lang"].".datosadicionales.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	$Pager = Application::loadservices("Pager");
	$Date = Application::loadServices("DateController");

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
	$sbHtml .= "<td class='titulofila' align=center colspan=3><strong>".$rclabels_generic['acciones']."</strong></td>\n";
	$sbHtml .= "</tr>\n";

	if($rcData)
	{
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
			//$sbHtml .= "<td class='".$sbEstilo."' align=center>".
			//"<a href='index.php?action=".$sbModulePref."CmdShoyByIdDetalledimens".$sbRequest.
			//"'><img border=0 src=web/images/editar.gif title='".$rclabels_generic['update']."'></a></td>\n";
			
			//ELIMINAR
			$sbHtml .= "<td class='".$sbEstilo."' align=center>".
			"<a href='index.php?action=".$sbModulePref."CmdDeleteDetalledimens".$sbRequest.
			"'><img border=0 src=web/images/ico_basura.gif title='".$rclabels_generic['delete']."'></a></td>\n";

			$sbHtml .= "</tr>";
			$nuCount++;
		}
	}
	//NUEVO
	$sbHtml .= "</table>";
	return $sbHtml;

}

function getDetalles($dimecodigon)
{
	$objData = Application::getDomainController("DimensionManager");
	$rcData = $objData->getDetalles($dimecodigon);
	return $rcData;
}
?>