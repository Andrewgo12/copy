<?php
/**Copyright 2005 FullEngine

consulta y pinta la informacion de los dealers a ser aprobados para liquidacion
@author freina <freina@parquesoft.com>
@date 01-Mar-2005 13:55
@location Cali - Colombia
*/
require_once('html2fpdf.php');
require_once('html2doc.php');
function smarty_function_closePdf($params,&$smarty)
{
	extract($params);
	extract($_REQUEST);
	settype($rcUser,"array");
	settype($sbUmask,"string");
	settype($sbPath,"string");
	settype($sbTmp,"string");
	settype($sbPathPDF,"string");

	$rcUser = Application::getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".viewreport.php");

	//Output-Buffer in variable:
	$html = ob_get_contents();

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

	$namePdf = $name.rand(0,1000).".pdf";
	//$nameDoc = str_replace(".pdf",".doc",$namePdf);
	$nameExcel = str_replace(".pdf",".xls",$namePdf);

	//HTML TO PDF
	$pdf = new HTML2FPDF();
	$pdf->DisplayPreferences('HideWindowUI');
	$pdf->AddPage();
	$pdf->WriteHTML($html);
	$sbPathPDF = $sbTmp."/".$namePdf;
	$pdf->Output($sbPathPDF,'F');

	//HTML TO WORD
	/*
	$html = str_replace("tmp/images/","images/",$html);
	$html = str_replace("web/","../web/",$html);
	$htmltodoc= new HTML_TO_DOC();
	$htmltodoc->createDoc($html,'tmp/'.$nameDoc);
	*/

	//HTML TO EXCEL
	//Instancia la libreria y genera el libro
	$sbPath = $sbTmp."/".$nameExcel;
	$objLib = Application::loadLib("excel");
	$sbResult = $objLib->execute($rcData,$sbPath);

	$sbHtml = "<tr><td align=center class='piedefoto'><a href=javascript:abrirPdf('".$sbPathPDF."');><img border=0 src='web/images/PDF.gif' alt='".$rclabels['pdf']['label']."'></a>";
	$sbHtml .= "&nbsp;<a href=javascript:abrirPdf('".$sbPath."');><img border=0 src='web/images/generar_excel.gif' alt='".$rclabels['excel']['label']."'></a></td></tr>";
	return $sbHtml;
}
?>