<?php
/**
 * @copyright Copyright 2004 &copy; FullEngine
 *
 *  Consulta y descarga archivos
 * @author freina <freina@parquesoft.com>
 * @date 03-Jul-2010 18:49
 * @location Cali-Colombia
 */
function smarty_function_downloadExcel($params, &$smarty){

	settype($rcUser,"array");
	settype($sbPath,"string");
	settype($sbHtml,"string");

	extract($_REQUEST);
	if(!$excel_file){
		echo "<script language='javascript'>window.close();</script>";
		return null;
	}

	$sbPath = Application :: getTmpDir();

	$sbPath = substr($sbPath,(strpos($sbPath,"/")+1));

	$excel_file = $sbPath.Application::getConstant("SLASH").$excel_file;

	if(!file_exists($excel_file)){
		echo "<script language='javascript'>window.close();</script>";
		return null;
	}

	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")){
		$sbHtml = '<html><tr><td>';
		$sbHtml .= "<a href=# onclick=\"win = window.open('".$excel_file."','','top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500');window.close();\">";
		$sbHtml .= $rclabels_crl['CmdDownload']."</a>";
		$sbHtml .= '</td></tr></html>';
		echo $sbHtml;
	}else{
		header("Pragma: public");                                                // purge the browser cache
		header("Expires: 0");                                                    // ...
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: application/force-download");
		header("Content-Disposition: attachment; filename=\"".basename($excel_file)."\";");
		header("Content-Transfer-Encoding: binary");                             // transfer method
		header("Content-Length: ".filesize($excel_file));
		readfile($excel_file);
		die();
	}
}
?>