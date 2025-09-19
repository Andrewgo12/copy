<?php
/**
 * @copyright Copyright 2004 &copy; FullEngine
 *
 *  Consulta y descarga archivos
 * @author creyes <cesar.reyes@parquesoft.com>
 * @date 21-sep-2004 9:05:31
 * @location Cali-Colombia
 */
function smarty_function_downloadfile($params, &$smarty){

	extract($_REQUEST);
	settype($objService,"object");
	settype($objGateway,"object");
	settype($rcFile,"array");
	settype($sbPointer ,"string");
	settype($sbPath ,"string");
	settype($sbUmask,"string");

	if(!$archcodigon){
		echo "<script language='javascript'>window.close();</script>";
		return null;
	}
	$objService = Application::loadServices('General');
	$objGateway = $objService->loadGateway('Archivos');
	$rcFile = $objGateway->getByIdArchivos($archcodigon);
	$objService->close();
	if(!$rcFile[0]['archcontens']){
		echo "<script language='javascript'>window.close();</script>";
		return null;
	}

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false);
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=\"".$rcFile[0]['archnombres']."\";");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".$rcFile[0]['archtamanon']);
	set_time_limit(0);
	$objService = Application::loadServices('Data_type');
	$sbPath = Application :: getTmpDirectory();
	//Se valida si el directorio existe
	if(!is_dir($sbPath)){
		$sbUmask = umask(0);
		mkdir($sbPath, 0775);
		umask($sbUmask);
	}
	$sbPath .= Application::getConstant("SLASH").$rcFile[0]['archnombres'];
	$sbPointer  = fopen($sbPath, 'a');
	fwrite($sbPointer, $objService->decode($rcFile[0]['archcontens']));
	fclose($sbPointer);
	readfile($sbPath);
	unlink($sbPath);
}
?>