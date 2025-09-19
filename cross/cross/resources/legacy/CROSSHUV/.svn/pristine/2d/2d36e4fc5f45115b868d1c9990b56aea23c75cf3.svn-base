<?php
/*
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* smarty function
	*  Pinta el reporte de saldos por bodega
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 8:59:21
	* @location Cali-Colombia**/
function smarty_function_repo_saldobodega($params,& $smarty) {
	
	//Trae el codigo de los recursos seriados
	$codRecSerial = Application :: getConstant("COD_REC_SER");
	//Carga el manager del reporte
	$manager = Application :: getDomainController("SaldobodegaManager");
	//Verifica que reporte hacer seriales o no
	if($_REQUEST["tirecodigos"] == $codRecSerial){
		if($_REQUEST["bodecodigos"])
			if($_REQUEST["recucodigos"])
				$sql = $manager->getSqlserialByBodegaRecurso($_REQUEST["bodecodigos"],$_REQUEST["recucodigos"]);
			else
				$sql = $manager->getSqlserialByBodega($_REQUEST["bodecodigos"]);
		else
			if($_REQUEST["recucodigos"])
				$sql = $manager->getSqlserialByRecurso($_REQUEST["recucodigos"]);
			else
				$sql = $manager->getSqlAllserial();
	}else{
		if($_REQUEST["bodecodigos"])
			if($_REQUEST["recucodigos"])
				$sql = $manager->getSqlSaldosBybodegaRecurso($_REQUEST["bodecodigos"],$_REQUEST["recucodigos"]);
			else
				$sql = $manager->getSqlSaldosBybodega($_REQUEST["bodecodigos"]);
		else
			if($_REQUEST["recucodigos"])
				$sql = $manager->getSqlSaldosByRecurso($_REQUEST["recucodigos"]);	
			else
				$sql = $manager->getSqlAllSaldos();
	}
	$rcreq["sql"] = $sql;
	$rcreq["table"] = "saldobodega";
	$rcreq["order_by"] = $order_by;
	$rcreq["form"] = "frmSaldobodega"; // add by Diego Ramirez Software House
	$rcreq["cache"] = false;
	$rcreq["num_rows"] = 25;
	if($_REQUEST["numrows"])
		$rcreq["num_rows"] = $_REQUEST["numrows"];
	$rcreq["datefields"] = "sasefechregn,saldfechregn";
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!$table && !is_array($rcuser))
		return;
	//Carga las etiquetas de la tabla en la sesion
	$table_name = strtolower($rcreq["table"]);
	include ($rcuser["lang"]."/".$rcuser["lang"].".saldobodega.php");

	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, 'CR3', true, false);
	$pager->Render();	
}
?>