<?php
/*
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* smarty function
	*  Pinta el reporte de movimientos de almacen por bodega, recurso, documento y fechas
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 8:59:21
	* @location Cali-Colombia**/
function smarty_function_repo_recuseribode($params,&$smarty) {

	extract($_REQUEST);
	
	//Analiza los datos de entrada
	if(!$serial)
		return null;
	
	//Carga el manager del reporte
	$gateWay = Application::getDataGateway("reportes");
	$sql = $gateWay->getSqlTrackSerial($serial, $recucodigos);

	$rcreq["sql"] = $sql;
	$rcreq["table"] = "repomovimialmace";
	$rcreq["order_by"] = $order_by;
	$rcreq["form"] = "frmReporecuseribode"; // add by Diego Ramirez Software House
	$rcreq["cache"] = false;
	$rcreq["num_rows"] = 25;
	if($numrows)
		$rcreq["num_rows"] = $numrows;
	$rcreq["datefields"] = "resbfechmovi";
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!$table && !is_array($rcuser))
		return;
	//Carga las etiquetas de la tabla en la sesion
	$table_name = strtolower($rcreq["table"]);
	include ($rcuser["lang"]."/".$rcuser["lang"].".reporecuseribode.php");

	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, 'CR3', true, false);
	$pager->Render();	
}
?>