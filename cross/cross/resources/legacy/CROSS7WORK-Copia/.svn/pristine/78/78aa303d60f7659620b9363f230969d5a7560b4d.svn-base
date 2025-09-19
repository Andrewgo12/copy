
<?php 
/*** @Copyright 2004
* @author creyes <cesar.reyes@parquesoft.com>
* @date 14-feb-2005 14:44:19
* @location Cali - Colombia
* example: {consult_table table_name="personal" llaves="perscodigos" form_name="
* frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"
* queryparam=" perscodigos,persnombres"}
*/
include_once("html2fpdf.php");
include_once("html2doc.php");
function smarty_function_deactivate_html2doc($params, & $smarty)
{
    extract($params);
    extract($_REQUEST);
    $rcUser = Application :: getUserParam();
    if(!is_array($rcUser))
    return;
    
    if(!$formulario__formcodigon)
    return false;
    
    $sbImage = 'web/images/word.gif';
    //$sbImage = 'web/images/pdf.gif';
    
    $sbHtml = ob_get_contents();
    
    /*
    $sbHtml ='<html><head><title></title></head><body>'.$sbHtml;
    $sbHtml = str_replace('<table border="0" align="center" width="60%">','<table border="0" align="center" width="100%">',$sbHtml);
    $sbHtml = str_replace('web/css/estilos.css','../web/css/estilos.css',$sbHtml);
    $sbHtml = str_replace('../general/tmp/images','../../general/tmp/images',$sbHtml);
    $sbHtml =$sbHtml.'</body></html>';
    */
	$sbName = "tmp/".$rcUser['username'].'_'.$formulario__formcodigon.".doc";
	
	//HTML 2 DOC
	$sbHtml = fnctildea_a_cute_WORD($sbHtml);
	$htmltodoc= new HTML_TO_DOC();
	$htmltodoc->createDoc($sbHtml,$sbName);
	
	/*
	//HTML 2 PDF
	$pdf = new HTML2FPDF();
	$pdf->DisplayPreferences('HideWindowUI');
	$pdf->AddPage();
	$pdf->WriteHTML($sbHtml);
	$pdf->Output($sbName,'F');
	*/
	
	$html ='<table border="0" align="center" width="60%">';
	$html .='<th>';
	$html .= "<a href=\"#\" onclick=\"abrirPdf('".$sbName."');\"><img border=0 title='Exportar a WORD' src='".$sbImage."' name=image></a>";
	$html .='</th>';
	$html .='</table>';
    
	return $html;
}

function fnctildea_a_cute_WORD($isbcadena)
{
	if(!$isbcadena){
		return $isbcadena;
	}
	$isbcadena = str_replace("á","&aacute;",$isbcadena);
	$isbcadena = str_replace("é","&eacute;",$isbcadena);
	$isbcadena = str_replace("í","&iacute;",$isbcadena);
	$isbcadena = str_replace("ó","&oacute;",$isbcadena);
	$isbcadena = str_replace("ú","&uacute;",$isbcadena);
	$isbcadena = str_replace("Á","&Aacute;",$isbcadena);
	$isbcadena = str_replace("É","&Eacute;",$isbcadena);
	$isbcadena = str_replace("Í","&Iacute;",$isbcadena);
	$isbcadena = str_replace("Ó","&Oacute;",$isbcadena);
	$isbcadena = str_replace("Ú","&Uacute;",$isbcadena);
	$isbcadena = str_replace("ñ","&ntilde;",$isbcadena);
	$isbcadena = str_replace("Ñ","&Ntilde;",$isbcadena);
	return $isbcadena;
}
?>