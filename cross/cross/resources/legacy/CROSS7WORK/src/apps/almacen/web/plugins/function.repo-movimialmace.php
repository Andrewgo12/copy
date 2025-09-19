<?php 
/*
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* smarty function
	*  Pinta el reporte de movimientos de almacen por bodega, recurso, documento y fechas
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 8:59:21
	* @location Cali-Colombia**/
function smarty_function_repo_movimialmace($params, & $smarty) {

	extract($_REQUEST);
	//Instancia el servicio de formato de fechas
	$dateSevice = Application :: loadServices("DateController");
	//Analiza y convierte las fechas
	if ($moalfechmovd1 && $moalfechmovd2) {
		$moalfechmovd1 = $dateSevice->fncdatehourtoint($moalfechmovd1);
		$moalfechmovd2 = $dateSevice->fncdatehourtoint($moalfechmovd2);
	}
	elseif (!$moalfechmovd1 && !$moalfechmovd2) {
		$moalfechmovd1 = $dateSevice->fncintdatehour();
		$moalfechmovd2 = $dateSevice->fncintdatehour();
	}
	elseif ($moalfechmovd1 && !$moalfechmovd2) {
		$moalfechmovd1 = $dateSevice->fncdatehourtoint($moalfechmovd1);
		$moalfechmovd2 = $dateSevice->fncintdatehour();
	}
	elseif (!$moalfechmovd1 && $moalfechmovd2) {
		$moalfechmovd1 = 0;
		$moalfechmovd2 = $dateSevice->fncdatehourtoint($moalfechmovd2);
	}
	//Carga el manager del reporte
	$gateWay = Application::getDataGateway("reportes");
	$sql = $gateWay->getMovimialmace($moalfechmovd1,$moalfechmovd2,$moalnumedocs,$bodecodigos,$recucodigos);

	$rcreq["sql"] = $sql;
	$rcreq["table"] = "repomovimialmace";
	$rcreq["order_by"] = $order_by;
	$rcreq["form"] = "frmRepomovimialmace"; // add by Diego Ramirez Software House
	$rcreq["cache"] = false;
	$rcreq["num_rows"] = 25;
	if ($numrows)
		$rcreq["num_rows"] = $numrows;
	$rcreq["datefields"] = "moalfechmovd";
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	//Carga las etiquetas de la tabla en la sesion
	$table_name = strtolower($rcreq["table"]);
	include ($rcuser["lang"]."/".$rcuser["lang"].".repomovimialmace.php");

	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, 'CR3', true, false);
	$pager->Render();
}
?>