<?php
/**Copyright 2005 FullEngine

consulta y pinta la informacion de los dealers a ser aprobados para liquidacion
@author freina <freina@parquesoft.com>
@date 01-Mar-2005 13:55
@location Cali - Colombia
*/
function smarty_function_closePdfDurCal($params,&$smarty)
{
	extract($params);
	extract($_REQUEST);
	settype($rcUser,"array");
	settype($sbUmask,"string");
	settype($sbPath,"string");
	settype($sbTmp,"string");
	
	$rcUser = Application::getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".viewreport.php");

	//Hallemos el nombre del documento a generar
	$sbPath = Application::getTmpDirectory();
	//se valida la existencia del directorio
	if(!is_dir($sbPath)){
		$sbUmask = umask(0);
		mkdir($sbPath, 0775);
		umask($sbUmask);
	}
	$sbTmp = Application :: getTmpDir();
	$sbTmp = substr($sbTmp,(strpos($sbTmp,"/")+1));
	$nameExcel = $name.rand(0,1000).".xls";
	
	//HTML TO EXCEL
	//Instancia la libreria y genera el libro
	$sbPath = $sbTmp.Application::getConstant("SLASH").$nameExcel;
	$objLib = Application::loadLib("excel");
	$sbResult = $objLib->execute($rcData,$sbPath);
	
	$sbHtml = "<tr><td align=center class='piedefoto'><a href=javascript:abrirPdf('".$sbPath."');><img border=0 src='web/images/generar_excel.gif' alt='".$rclabels['excel']['label']."'></a></td></tr>";
	return $sbHtml;
}
?>