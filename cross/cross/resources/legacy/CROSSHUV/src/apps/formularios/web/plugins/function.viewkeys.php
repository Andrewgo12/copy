<?php
function smarty_function_viewKeys($params,&$smarty){
	
	extract($_REQUEST);
	settype($rcResult,"array");
	
	if(!isset($keys))
		return false;
	else
	{
		$rcUser = Application::getUserParam();
		$manager = Application::getDomainController("UsuarioManager");
		
		$rcKeys = $manager->getKeysByEstucodigon($estudio__estucodigon);
		if(!is_array($rcKeys))
			return false;
		else
		{
			$objProfiles = Application::loadServices("Profiles");
			$sbNit = $objProfiles->loadNitCliente();
			$objProfiles->close();
			
			foreach ($rcKeys as $nuCont=>$rcRow)
			{
				$rcResult[$nuCont] = array($sbNit,$rcRow["usuaclaven"]);
			}
			if(is_array($rcResult))
				return getExcelBook($rcResult,array("NIT","CLAVE"));
		}
	}
}

function getExcelBook($rcDatos,$rclabels)
{
	$sbTmp = "tmp/";
	$nameExcel = $name.rand(0,1000).".xls";
	$sbPath = $sbTmp.$nameExcel;
	
	$objLib = Application::loadLib("excel");
	array_unshift($rcDatos,array());
	array_unshift($rcDatos,$rclabels);
	$sbResult = $objLib->execute($rcDatos,$sbPath);
	
	return "<script>abrirExcel('".$sbPath."');</script>";
}
?>